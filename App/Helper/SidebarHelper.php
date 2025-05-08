<?php

namespace App\Helpers;
use App\Helpers\ChildHelper;
use App\Helpers\ParentHelper;

class SidebarHelper
{
    public function store_sidebar()
    {
        $childHelper = new ChildHelper();
        $parentHelper = new ParentHelper();

        $children = $childHelper->store_child();
        $parent = $parentHelper->store_parent();
        
        $data = [];
        $imageData = $parent->Image;
        $imageType = $parent->ImageType;
        $base64Image = (!empty($imageData) && is_string($imageData)) 
            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
            : null;

        $data['parent'] = [
            'fullname' => $parent->First_Name . ' ' . $parent->Last_Name,
            'image' => $base64Image,
            'childcount' => count($children),
            'lastseen' => $parent->Last_Seen,
            'firstname' => $parent->First_Name,
            'lastname' => $parent->Last_Name,
            'lastseen' => lastSeen($parent->Last_Seen),
        ];

        foreach ($children as $index => $child) {
            $fullName = $child->First_Name . " " . $child->Last_Name;
            $imageData = $child->Image;
            $imageType = $child->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData)) 
                ? 'data:image/jpeg;base64,' . base64_encode($imageData) 
                : null;

            $data['children'][$index] = [
                'Id' => $child->ChildID,
                'name' => $child->First_Name,
                'fullname' => $fullName,
                'image' => $base64Image,
            ];
        }

        return $data;
    }
}

?>