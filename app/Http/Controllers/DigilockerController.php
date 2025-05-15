<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class DigilockerController extends Controller
{

    public function getParameters()
    {

        // Set your app-specific values
        $client_id = 'DC5C9B24F4';
        $redirect_uri = 'http://127.0.0.1:8000/login'; // Must match the one registered with DigiLocker
        $state = Str::random(16); // Random string to maintain state between request and callback
        $scope = 'openid';
        $response_type = 'code';
        $code_challenge_method = 'S256';


        // Check if already exists in session
        $code_verifier = Session::get('digilocker_code_verifier');
        $code_challenge = Session::get('digilocker_code_challenge');

        if (!$code_verifier || !$code_challenge) {
            $challengeData = $this->generate_code_challenge_verifier(96, $code_challenge_method);
            $code_verifier = $challengeData['code_verifier'];
            $code_challenge = $challengeData['code_challenge'];

            Session::put('digilocker_code_verifier', $code_verifier);
            Session::put('digilocker_code_challenge', $code_challenge);
        }

        Session::put('digilocker_state', $state);




        return response()->json([
            'response_type' => $response_type,
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'state' => $state,
            'scope' => $scope,
            'code_challenge' => $code_challenge,
            'code_challenge_method' => $code_challenge_method,
        ]);

    }

    public function getToken($code)
    {
        $grant_type = 'authorization_code';
        $client_id = 'DC5C9B24F4';
        $client_secret = '313823e81d0d7b819276';
        $redirect_uri = 'http://127.0.0.1:8000/login';
        $code_verifier = Session::get('digilocker_code_verifier');


        $response = Http::asForm()->post('https://digilocker.meripehchaan.gov.in/public/oauth2/2/token', [
            'code' => $code,
            'grant_type' => $grant_type,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'code_verifier' => $code_verifier, // for PKCE
        ]);

        $data = $response->json();

        if ($response->successful() && isset($data['access_token'])) {
            // Clear verifier from session
            Session::forget('digilocker_code_verifier');
            Session::forget('digilocker_code_challenge');
            Session::forget('digilocker_state');

            return $data['access_token'];
        }

        return 'Failed to fetch access token';
    }

    public function getUser($token){

//        dd($token);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://digilocker.meripehchaan.gov.in/public/oauth2/1/user');

        // Store the response in an array
        $data = $response->json();

        if ($response->successful()) {
            return $data; // returning plain access token
        }
        return 'Failed to Fetch User Data';
    }

    public function revokeToken($token, $tokenTypeHint = null)
    {
        $response=Http::withHeaders([
            'Authorization' => "Bearer " . $token,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->post("https://digilocker.meripehchaan.gov.in/public/oauth2/1/revoke",[
            'token' => $token,
            'token_type_hint' => $tokenTypeHint,
        ]);
        if ($response->successful()) {
            return 'Token revoked successfully.';
        }
        return 'Failed to revoke token: ' . $response->body();

    }
    // Helper functions
    private function generate_code_challenge_verifier($nbytes, $method)
    {
        $code_verifier = $this->base64_url_encode_without_padding(random_bytes($nbytes));

        if ($method === 'S256') {
            $hash = hash('sha256', $code_verifier, true); // raw output = true
            $code_challenge = $this->base64_url_encode_without_padding($hash);
        } else {
            $code_challenge = $code_verifier;
        }

        return [
            'code_verifier' => $code_verifier,
            'code_challenge' => $code_challenge,
        ];
    }

    private function base64_url_encode_without_padding($input)
    {
        return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
    }

}
