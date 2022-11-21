<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_templates')->delete();
        
        \DB::table('notification_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'OTP',
                'templateId' => 'OTP',
                'description' => 'OTP',
                'data' => '
                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMIS | Ethiopia</title>
    <script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
    rel="stylesheet">
    
    <style>
        .layout {
            width: 90%;
            max-width: 550px;
        }

        @media (min-width: 768px) { 
            .amico {
  width: 33.333333%; 

            }
 }

 .btn-primary:hover {
    background: #245487;
 }

 .email-link:hover {
     color: #245487;
 }

    </style>
</head>
<body style="position: relative; font-family: "poppins", sans-serif;">
    <header style="position: relative; width: 100%; height: 9rem; background: #3170b5;">
        <img src="https://i.postimg.cc/T3WFvf0C/logo.png" style="padding-top: 1rem; 
width: 11rem; margin: 0 auto; 
">
        <div class="layout" style="display: flex; 
position: absolute; 
top: 6rem; 
left: 50%; 
margin-top: 1rem; 
transform: translateX(-50%);
flex-direction: column; 
">
<div style="padding: 1rem; 
background-color: #ffffff; 
border-radius: 0.375rem; 
box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); ">
        <img src="https://live.staticflickr.com/65535/52391751547_56c0f0afbf_n.jpg" class="amico" style="margin: 0rem auto 2rem auto; 
width: 50%; " alt="email">

    <h1 style="margin-bottom: 1rem; 
font-size: 1.875rem;
line-height: 2.25rem; 
text-align: center; 
text-transform: capitalize; 
color: #3170b5;">welcome</h1>
    <p style="margin-bottom: 2rem; 
text-align: center; ">Dear, we are excited to have you get started. first,
        you need to confirm your account.just press the button below.</p>
    <div style="display: flex; 
justify-content: center; 
width: 100%;">
        <button class="btn-primary"
            style="padding: 1rem; 
margin-bottom: 2rem; 
transition-property: all; 
transition-duration: 200ms; 
transition-timing-function: cubic-bezier(0.4, 0, 1, 1); 
color: #ffffff; 
text-transform: capitalize; 
border-radius: 0.375rem; 
box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); 
background: #3170b5;">confirm
            account</button>
    </div>


    <p style="margin-bottom: 1rem; 
text-align: center; 
text-transform: capitalize; ">if that does not work, copy and
        paste the following link in your browser:
    </p>
    <div style="display: flex; 
justify-content: center; 
width: 100%; ">
        <a class="email-link" style="margin-bottom: 1rem; 
transition-property: all; 
transition-duration: 200ms; 
transition-timing-function: cubic-bezier(0.4, 0, 1, 1); 
text-decoration: underline; 
color: #3170b5;"
            href="https://lmis.gov.et/">https://lmis.gov.et/</a>
    </div>


    <p style="margin-bottom: 3rem; 
text-align: center; 
text-transform: capitalize; ">if you have any questions, just
        reply to this email- we are always happy to help out.
    </p>

    <h3 style="margin-bottom: 0.5rem; color:#777">Good luck,</h3>
    <p style="color:#777">LMIS Support team</p>
</div>

<div class="layout" style="display: flex; 
padding: 1rem; 
margin-bottom: 1rem; 
margin-top: 2rem; 
flex-direction: column; 
align-items: center; 
width: 100%; 
border-radius: 0.375rem; 
background: #3171b543;
">
    <h3 style="text-transform: capitalize; margin-bottom: .5rem;">need more help</h3>
    <a  href="https://lmis.gov.et/" class="email-link" style="transition-property: all; 
transition-duration: 200ms; 
transition-timing-function: cubic-bezier(0.4, 0, 1, 1); 
text-decoration: underline; 
color: #3170b5;">we are here reach us</a>
</div>
        </div>
        
    </header>   
</body>
</html>',
                'is_active' => 1,
                'email_account_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}