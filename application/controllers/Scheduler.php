<?php
defined('BASEPATH') OR exit('');

class Scheduler extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function createMonthlySalariesCost() {
        // Check if today is the first day of the month
        if (date('d') == '01') {
            // Load the necessary models and libraries
            $this->load->model('cost'); // Load the Cost model
    
            // Check if a cost with the current month and year as the name already exists
            $currentMonthYear = date('Y_M');
            $costName = $currentMonthYear . '_Salaries';
    
            $existingCost = $this->cost->getCostInfo(['name' => $costName]);
    
            if (!$existingCost) {
                // Calculate the total basic salary and set it as the amount
                $this->load->model('staff'); // Load the Staff model
                $totalBasicSalary = $this->staff->totalBasicSalary(); // You should have a function in your Staff model to calculate the total basic salary
                $amount = $totalBasicSalary;
    
                // Set the initial balance as the same as the amount
                $balance = $amount;
    
                // Set the status as 0 (inactive)
                $status = 0;
    
                // Set the category as 'Salary' or the appropriate category you want
                $costCategory = 'Salary';
    
                // Set the description
                $description = 'Monthly Salaries Cost';
    
                // Set the currency
                $currency = 'USD';
    
                // Set the initial paid amount to 0
                $paid = 0;
    
                // Add the cost to the database individually
                $insertedId = $this->cost->add($costName, $amount, $costCategory, $description, $currency, $status, $balance, $paid);
    
                // Log the event as done by the system
                $eventDescription = "Creation of new Cost by the system: {$costName} with Amount '{$amount}', Currency '{$currency}' and Category '{$costCategory}' to the Costs.";
                $this->genmod->addevent("System Event", $insertedId, $eventDescription, "costs", 0); // Set the admin_id to 0 to indicate it's a system event
    
                log_message('info', 'Salaries cost created for ' . $currentMonthYear);
            }
        }
    }
    
    
}
