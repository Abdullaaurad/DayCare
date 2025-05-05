<?php

namespace Controller;
use App\Helpers\ManagerHelper;

use Modal\Modal;

defined('ROOTPATH') or exit('Access denied');

class Foodtable
{
    use MainController;
    public function index()
    {
        $Helper = new ManagerHelper;
        $Helper->Check_Manager();
        $data['Meal'] = $this->food_items();
        // show($data);
        $this->view('Manager/Foodtable', $data);
 
    }

    private function getRandomMeals($array, $count = 3) {
        shuffle($array);
        return array_slice($array, 0, $count);
    }

    private function generateMeal(){
        $Breakfast = [
            "String Hoppers with Kiri Hodi",
            "Pol Roti with Lunu Miris",
            "Milk Rice (Kiribath)",
            "Pittu with Coconut Sambol",
            "Vegetable Upma",
            "Dhal Curry with Roast Paan",
            "Hoppers with Egg and Seeni Sambol",
            "Banana Pancakes",
            "Idiyappam with Coconut Milk",
            "Bread with Fish Cutlet",
            "Egg Sandwich",
            "Toasted Bread with Butter and Jam",
            "Vegetable Roti",
            "Fruit Salad with Yogurt",
            "Semolina Porridge",
            "Oats with Banana and Honey",
            "Sweet Pongal",
            "Bread and Pol Sambol",
            "Chickpea Stir Fry",
            "Masala Omelette with Toast"
        ];
        
        $Lunch = [
            "Rice with Chicken Curry and Beans",
            "Fried Rice with Devilled Chicken",
            "Yellow Rice with Pineapple Curry",
            "Jackfruit Curry with Red Rice",
            "Vegetable Biriyani",
            "Parippu (Lentil) Curry with Cabbage Mallung",
            "Rice with Fish Ambulthiyal",
            "Egg Curry with Snake Gourd",
            "Soya Meat Curry with Spinach",
            "Crab Curry with White Rice",
            "Prawn Curry with Drumsticks",
            "Beetroot Curry with White Rice",
            "Rice with Fish Cutlet and Brinjal Fry",
            "Cashew Curry with Yellow Rice",
            "Mushroom Stir Fry with Noodles",
            "Lentil Stew with Vegetable Rice",
            "Rice with Mango Curry and Coconut Sambol",
            "Chicken Stew with Mixed Rice",
            "Tempered Potato with Pumpkin Curry",
            "Tomato Rice with Fried Eggplant"
        ];

        $Dinner = [
            "Noodles with Stir-fried Vegetables",
            "Roti Wraps with Chicken",
            "Bread and Omelette",
            "Rice with Brinjal Moju",
            "Vegetable Soup with Toast",
            "Vegetable Kottu",
            "Chapati with Paneer Curry",
            "Egg Fried Rice",
            "Dhal and Pumpkin Curry with Rice",
            "Rice and Fish Fingers",
            "Vegetable Sandwich with Soup",
            "Chilli Paratha Rolls",
            "Rice with Lotus Root Curry",
            "Creamy Pasta with Veggies",
            "Tomato Soup with Garlic Bread",
            "Sausage Stir Fry with Rice",
            "Boiled Manioc with Lunu Miris",
            "Kola Kenda with Paan",
            "Spaghetti with Chicken Slices",
            "Mung Bean Curry with Bread"
        ];
        
        // Create meal plan for 3 days
        $mealPlan = [];
        
        for ($day = 1; $day <= 3; $day++) {
            $mealPlan = [
                'Breakfast' => $this->getRandomMeals($Breakfast),
                'Lunch' => $this->getRandomMeals($Lunch),
                'Dinner' => $this->getRandomMeals($Dinner),
            ];
        }

        return $mealPlan;
    }

    private function insertfood($data, $time, $label) {
        $Modal = new \Modal\FoodPlan;
        $realDate = $this->getRealDate($label);
    
        foreach ($data as $food) {
            $foodData = [
                'Food' => $food,
                'Time' => $time,
                'Date' => $realDate
            ];
            // $Modal->insert($foodData);
        }
    }
    

    private function getRealDate($label) {
        switch ($label) {
            case 'today':
                return date('Y-m-d');
            case 'tomorrow':
                return date('Y-m-d', strtotime('+1 day'));
            case 'dayafter':
                return date('Y-m-d', strtotime('+2 days'));
            default:
                return null; // Or throw error if needed
        }
    }    
    
    public function food_items() {
        $Modal = new \Modal\FoodPlan;
        $Foodtable = $Modal->findall_order("Date", "DESC");
    
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $dayafter = date('Y-m-d', strtotime('+2 days'));
    
        $data = [];
    
        if (!empty($Foodtable)) {
            $latestDateInTable = $Foodtable[0]->Date;
        } else {
            $latestDateInTable = null;
        }
    
        // If no data or last date is older than today, generate and insert all 3 days
        if (!$latestDateInTable || $latestDateInTable < $today) {
            $data['today'] = $this->generateMeal();
            $data['tomorrow'] = $this->generateMeal();
            $data['dayafter'] = $this->generateMeal();

            $this->insertfood($data['today']['Breakfast'], "Breakfast", $today);
            $this->insertfood($data['today']['Lunch'], "Lunch", $today);
            $this->insertfood($data['today']['Dinner'], "Dinner", $today);
    
            $this->insertfood($data['tomorrow']['Breakfast'], "Breakfast", $tomorrow);
            $this->insertfood($data['tomorrow']['Lunch'], "Lunch", $tomorrow);
            $this->insertfood($data['tomorrow']['Dinner'], "Dinner", $tomorrow);
    
            $this->insertfood($data['dayafter']['Breakfast'], "Breakfast", $dayafter);
            $this->insertfood($data['dayafter']['Lunch'], "Lunch", $dayafter);
            $this->insertfood($data['dayafter']['Dinner'], "Dinner", $dayafter);
        } 
        elseif ($latestDateInTable == $today) {
            $data['today'] = [
                'Breakfast' => $Modal->where_norder(["Date" => $today, "Time" => "Breakfast"]),
                'Lunch'     => $Modal->where_norder(["Date" => $today, "Time" => "Lunch"]),
                'Dinner'    => $Modal->where_norder(["Date" => $today, "Time" => "Dinner"]),
            ];
            $data['tomorrow'] = $this->generateMeal();
            $data['dayafter'] = $this->generateMeal();
    
            $this->insertfood($data['tomorrow']['Breakfast'], "Breakfast", $tomorrow);
            $this->insertfood($data['tomorrow']['Lunch'], "Lunch", $tomorrow);
            $this->insertfood($data['tomorrow']['Dinner'], "Dinner", $tomorrow);
    
            $this->insertfood($data['dayafter']['Breakfast'], "Breakfast", $dayafter);
            $this->insertfood($data['dayafter']['Lunch'], "Lunch", $dayafter);
            $this->insertfood($data['dayafter']['Dinner'], "Dinner", $dayafter);
        } 
        elseif ($latestDateInTable == $tomorrow) {
            $data['today'] = [
                'Breakfast' => $Modal->where_norder(["Date" => $today, "Time" => "Breakfast"]),
                'Lunch'     => $Modal->where_norder(["Date" => $today, "Time" => "Lunch"]),
                'Dinner'    => $Modal->where_norder(["Date" => $today, "Time" => "Dinner"]),
            ];
            $data['tomorrow'] = [
                'Breakfast' => $Modal->where_norder(["Date" => $tomorrow, "Time" => "Breakfast"]),
                'Lunch'     => $Modal->where_norder(["Date" => $tomorrow, "Time" => "Lunch"]),
                'Dinner'    => $Modal->where_norder(["Date" => $tomorrow, "Time" => "Dinner"]),
            ];
            $data['dayafter'] = $this->generateMeal();
    
            $this->insertfood($data['dayafter']['Breakfast'], "Breakfast", $dayafter);
            $this->insertfood($data['dayafter']['Lunch'], "Lunch", $dayafter);
            $this->insertfood($data['dayafter']['Dinner'], "Dinner", $dayafter);
        } 
        else {
            // All 3 days exist, just fetch and return them
            $data['today'] = [
                'Breakfast' => $Modal->where_norder(["Date" => $today, "Time" => "Breakfast"]),
                'Lunch'     => $Modal->where_norder(["Date" => $today, "Time" => "Lunch"]),
                'Dinner'    => $Modal->where_norder(["Date" => $today, "Time" => "Dinner"]),
            ];
            $data['tomorrow'] = [
                'Breakfast' => $Modal->where_norder(["Date" => $tomorrow, "Time" => "Breakfast"]),
                'Lunch'     => $Modal->where_norder(["Date" => $tomorrow, "Time" => "Lunch"]),
                'Dinner'    => $Modal->where_norder(["Date" => $tomorrow, "Time" => "Dinner"]),
            ];
            $data['dayafter'] = [
                'Breakfast' => $Modal->where_norder(["Date" => $dayafter, "Time" => "Breakfast"]),
                'Lunch'     => $Modal->where_norder(["Date" => $dayafter, "Time" => "Lunch"]),
                'Dinner'    => $Modal->where_norder(["Date" => $dayafter, "Time" => "Dinner"]),
            ];
        }
    
        return $data;
    }      

    public function snack_items()
    {
        $data = [];
        $SnackModal = new \Modal\SnackPlan;
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $dayafter = date('Y-m-d', strtotime('+2 day'));
        $data['today'] = $SnackModal->where_norder(["Date" => $today]);
        $data['tomorrow'] = $SnackModal->where_norder(["Date" => $tomorrow]);
        $data['dayafter'] = $SnackModal->where_norder(["Date" =>$dayafter]);
        return $data;
    }
    
}
