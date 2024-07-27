<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conditions')->insert([
            [
                'name' => 'Burn',
                'description' => 'Run cool (not cold) water over the burn for 10-15 minutes. This helps to reduce the heat and prevent further injury. If the burn is severe, cover it with a sterile, non-stick bandage or clean cloth. Avoid applying ice or butter, as these can cause further damage. Elevate the affected area if possible to reduce swelling. Over-the-counter pain relievers such as ibuprofen or acetaminophen can help manage pain. If the burn is larger than three inches, involves the face, hands, feet, or genitals, or if you notice signs of infection (such as increased pain, redness, fever, swelling, or oozing), seek medical attention immediately. Keep the burn clean and dry. Change the bandage daily, and watch for signs of infection. Avoid breaking any blisters that form, as this can lead to infection. Moisturizing lotions or aloe vera gel can be applied once the burn has cooled to help prevent dryness and improve healing. For extensive burns, follow up with a healthcare provider to ensure proper healing and minimize scarring.',
            ],
            [
                'name' => 'Fracture',
                'description' => 'A fracture is a break or crack in a bone. Symptoms may include pain, swelling, bruising, and an inability to move the affected area. Immediate steps include immobilizing the area with a splint or brace and applying ice to reduce swelling. Avoid moving the fractured limb and seek medical attention as soon as possible. Treatment may involve setting the bone back in place and immobilizing it with a cast or splint. In some cases, surgery may be necessary to insert metal rods or plates to stabilize the bone. Pain management typically involves over-the-counter or prescription medications. Follow-up care often includes physical therapy to restore function and strength to the affected limb.',
            ],
            [
                'name' => 'Cut',
                'description' => 'A cut is an injury caused by a sharp object slicing through the skin. Initial steps for treating a cut include stopping the bleeding by applying gentle pressure with a clean cloth or bandage. Once the bleeding has stopped, clean the wound thoroughly with water and mild soap. Avoid using hydrogen peroxide or iodine, as they can irritate the tissue. Apply an antibiotic ointment to prevent infection and cover the cut with a sterile bandage. Change the bandage daily and keep the wound clean and dry. If the cut is deep, won’t stop bleeding, or shows signs of infection (such as redness, swelling, pus, or increased pain), seek medical attention. Stitches may be needed for deeper cuts. To minimize scarring, keep the wound moist with an ointment and covered until it heals. After the wound has healed, using sunscreen on the scar can help reduce its appearance.',
            ],
        ]);
        
    }
}
