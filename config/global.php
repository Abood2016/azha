<?php
return [
    'second_search' => false,
    'debit_amount' => 10,
    'try_send_notify' => 1,
    'radius' => 2000,
    'speed' => 40, //km/h
    'error_factory' => 1.3, //km
    'collection_drivers' => 'drivers',
    'collection_orders' => 'orders',
    'collection_test' => 'test',
    'notification_add' => array(
        'message' => 'Add Successfully',
        'alert-type' => 'success'
    ),
    'notification_edit' => array(
        'message' => 'Edit Successfully',
        'alert-type' => 'success'
    ),
    'notification_send' => array(
        'message' => 'Send Notification Successfully',
        'alert-type' => 'success'
    ),
    'manual_assign' => array(
        'message' => 'Manual Assign Successfully',
        'alert-type' => 'success'
    ),
    'paid_commission' => array(
        'message' => 'Paid Successfully',
        'alert-type' => 'success'
    ),
];
