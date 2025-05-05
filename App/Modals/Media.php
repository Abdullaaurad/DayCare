<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class Media {
    use Modal;

    protected $table = 'media';
    protected $allowedColumns = [
        "MediaType",
        "Title",
        "Description",
        "URL",
        "DateTime",
        "UserID",
        "Size",
        "Format",
        "Views",
        "Downloads",
        "Image",
        "ImageType"
    ];


public function validate($data)
{
    $errors = [];

    // Title validation
    if (empty($data['Title'])) {
        $errors['Title'] = "Title is required.";
    } elseif (strlen($data['Title']) > 100) {
        $errors['Title'] = "Title must not exceed 100 characters.";
    }

    // Description validation
    if (empty($data['Description'])) {
        $errors['Description'] = "Description is required.";
    } elseif (strlen($data['Description']) > 1000) {
        $errors['Description'] = "Description must not exceed 1000 characters.";
    }

    // Age group validation
    if (empty($data['AgeGroup'])) {
        $errors['AgeGroup'] = "Age group is required.";
    } elseif (!in_array($data['AgeGroup'], ['3-5', '6-9', '10-13'])) {
        $errors['AgeGroup'] = "Invalid age group selected.";
    }

    // Media type validation
    // if (empty($data['mediatype'])) {
    //     $errors['mediatype'] = "Media type is required.";
    // } elseif (!in_array($data['mediatype'], ['image', 'video', 'audio', 'document'])) {
    //     $errors['mediatype'] = "Invalid media type selected.";
    // }

    // var_dump($errors);
    // exit();

    return $errors;
}

}