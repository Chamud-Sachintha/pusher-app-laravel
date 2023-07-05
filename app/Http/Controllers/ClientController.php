<?php

namespace App\Http\Controllers;

use App\AppHelper\AppHelper;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

    private $AppHelper;
    private $Client;

    public function __construct() {
        $this->AppHelper = new AppHelper();
        $this->Client = new Client();
    }

    public function registerNewMember(Request $request_details) {

        $validated = $request_details->validate([
            'firstName' => 'required', 'lastName' => 'required', 'emailAddress' => 'required',
            'city' => 'required', 'password' => 'required'
        ]);

        try {
            $encrypted_pass = Hash::make($request_details['password']);

            $member_details['firstName'] = $request_details['firstName'];
            $member_details['lastName'] = $request_details['lastName'];
            $member_details['emailAddress'] = $request_details['emailAddress'];
            $member_details['city'] = $request_details['city'];
            $member_details['password'] = $encrypted_pass;
            $member_details['create_time'] = time();

            $member = $this->Client->addNewMember($member_details);

            if ($member) {
                $this->AppHelper->responseEntityHandle(101, "Member Created Successfully.", $member);
            } else {
                $this->AppHelper->responseMessageHandle(500, "Member Created UnSuccessfully.");
            }
        } catch (\Exception $e) {
            $this->AppHelper->responseMessageHandle(500, "Member Created UnSuccessfully." . $e->getMessage());
        }
    }
}
