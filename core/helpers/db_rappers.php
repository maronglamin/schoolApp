<?php
//  write the sql stmts in this file

function insert($table, $fields = [], $db_values = [])
{
    global $db;
    $fieldString = '';
    $valueString = '';
    $values = [];
    $values_db = [];

    foreach ($fields as $field => $value) {
        foreach ($db_values as $db_value => $db_val) {
            $fieldString .= '`' . $field . '`,';
            $valueString .= $db_value . ',';
            $values[] = $value;
            $values_db[] = $db_val;
        }
    }
    $fieldString = rtrim($fieldString, ',');
    $valueString = rtrim($valueString, ',');
    $db->query("INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})");
}
