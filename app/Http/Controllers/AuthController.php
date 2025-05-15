<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Barryvdh\DomPDF\Facade\Pdf; // Assuming you're using DomPDF


use App\Http\Controllers\DigilockerController;
use Inertia\Inertia;

class AuthController extends Controller
{
    //

    public function create2(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return response()->json(['error' => 'Authorization code not found'], 400);
        }



        $code_verifier = Str::random(64);
//        $code_challenge = rtrim(strtr(base64_encode(hash('sha256', $code_verifier, true)), '+/', '-_'), '=');
//
//
        $response = Http::asForm()->post('https://digilocker.meripehchaan.gov.in/public/oauth2/2/token', [
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_id' => 'DC5C9B24F4',
            'client_secret' => '313823e81d0d7b819276',
            'redirect_uri' => 'http://127.0.0.1:8000/login',
             'code_verifier' => 'DXF6RrViln-FcfBY5_VHBCapcQ80V_mTZjqvztlzLqGUgI-hk6HBHrB32eto-0n3Vh5MyakKDG2Emi5xcCwZaYylTu6T5v-wqb2XJWHnVqbBeAVEc-MQ5Y6PHV9iXTTW', // for PKCE
        ]);
//
//        dd($response->json());
        $data = $response->json();

        $accessToken = $data['access_token'];

//        log($accessToken);

        // Call the DigiLocker user details API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://digilocker.meripehchaan.gov.in/public/oauth2/1/user');

        // Store the response in an array
        $userDetails = $response->json();

        // Call the DigiLocker issued documents API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://digilocker.meripehchaan.gov.in/public/oauth2/2/files/issued');

        // Decode JSON response into an array
        $issuedDocuments = $response->json();

//        dd($issuedDocuments);

        // Get the Aadhaar Card document URI
        $aadhaarDocument = collect($issuedDocuments['items'])->firstWhere('name', 'Aadhaar Card');

        if (!$aadhaarDocument) {
            return response()->json(['error' => 'Aadhaar Card not found'], 404);
        }

        $uri = $aadhaarDocument['uri'];

        // Encode the URI
        $encodedUri = urlencode($uri);

//        dd($uri);
        // Make GET request to download the Aadhaar Card FILE
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://digilocker.meripehchaan.gov.in/public/oauth2/1/file/{$encodedUri}");

//        dd($response);
        // Check if file downloaded successfully
//        if (!$response->successful()) {
//            return response()->json(['error' => 'Failed to download Aadhaar file'], 500);
//        }

        // Determine mime type and file extension
        $contentType = $response->header('Content-Type');
        $extension = match ($contentType) {
            'application/pdf' => 'pdf',
            'application/xml' => 'xml',
            'application/json' => 'json',
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            default => 'bin',
        };

        // Generate a filename
        $filename = 'aadhaar_card.' . $extension;

        // Save file to storage/app/public/digilocker
        Storage::disk('public')->put("digilocker/{$filename}", $response->body());


        // Encode the URI
        $encodedUri = urlencode($uri);

        // Step 1: Call DigiLocker XML API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://digilocker.meripehchaan.gov.in/public/oauth2/1/xml/{$encodedUri}");

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to download XML from DigiLocker'], 500);
        }

        // Step 2: Convert XML to HTML for PDF
        $xmlContent = $response->body();

        // Optional: Parse XML if needed or directly wrap in <pre>
        $html = "<html><body><pre>" . htmlentities($xmlContent) . "</pre></body></html>";

        // Step 3: Generate PDF using DomPDF
        $pdf = Pdf::loadHTML($html);
        $pdfContent = $pdf->output();

        // Step 4: Store PDF in Laravel's storage
        $fileName = 'aadhaar_card_' . now()->timestamp . '.pdf';
        Storage::put("public/{$fileName}", $pdfContent);

//        return response()->json([
//            'error' => 'Failed to get access token',
//            'details' => $response->json()
//        ], $response->status());
//
        return inertia('Frontend/Auth/Login',[

        ]);
    }

//    public function create(){
//        return inertia('Frontend/Auth/Login', []);
//    }
    public function create(Request $request)
    {

        $digilocker = new DigilockerController();

        $code = $request->get('code');


        if ($code !== null) {
            $token = $digilocker->getToken($code);

            if ($token !== null) {
                $user_detail = $digilocker->getUser($token);

                if ($user_detail === 'Failed to Fetch User Data') {
                    return inertia('Frontend/Auth/Login', []);
                }

                // Check if user with mobile or email exists
                $user = User::where('mobile', $user_detail['mobile'])
                    ->orWhere('email', $user_detail['email'])
                    ->first();

                if ($user) {
                    // Log the user in
                    Auth::login($user);

                    // ✅ Revoke the token now
                    $digilocker->revokeToken($token, 'access_token'); // or 'refresh_token' if applicable
                    $code= null;
                    $token= null;
                    $user_detail=null;
                    // Redirect to dashboard
                    return redirect()->route('dashboard');

                }
                // If user not found, you might want to redirect back or show error
                return inertia('Frontend/Auth/Login', [
                    'error' => 'User not found. Please register first.',
                ]);
            }
        }

        return inertia('Frontend/Auth/Login', []);
    }

    public function store(LoginRequest $request)
    {
//        dd($request);
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));

    }
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Inertia::location('/');

//        return redirect('/');
    }
}
