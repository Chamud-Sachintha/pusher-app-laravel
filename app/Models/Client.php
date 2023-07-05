<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'emailAddress',
        'city',
        'password',
        'create_time'
    ];

    public function addNewMember($member_details) {
        return $this->create([
            'firstName' => $member_details['firstName'],
            'lastName' => $member_details['lastName'],
            'emailAddress' => $member_details['emailAddress'],
            'city' => $member_details['city'],
            'password' => $member_details['password']
        ]);
    }
}
