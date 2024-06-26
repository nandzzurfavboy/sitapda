<?php

function getData(
  $table,
  $columns = "*",
  $join = "",
  $condition = "",
  $orderBy = "",
  $limit = ""
) {
  global $conn;

  $query = "SELECT $columns FROM $table";

  if (!empty($join)) {
    $query .= " " . $join;
  }

  if (!empty($condition)) {
    $query .= " WHERE $condition";
  }

  if (!empty($orderBy)) {
    $query .= " ORDER BY $orderBy";
  }

  if (!empty($limit)) {
    $query .= " LIMIT $limit";
  }

  $statement = mysqli_prepare($conn, $query);
  mysqli_stmt_execute($statement);

  $data = array();
  $result = mysqli_stmt_get_result($statement);
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  mysqli_stmt_close($statement);
  return $data;
}

function createData($table, $data)
{
  global $conn;

  $table = mysqli_real_escape_string($conn, $table);

  $escapedData = array();
  foreach ($data as $column => $value) {
    $escapedColumn = mysqli_real_escape_string($conn, $column);
    $escapedValue = mysqli_real_escape_string($conn, $value);
    $escapedData[$escapedColumn] = $escapedValue;
  }

  $columns = implode(", ", array_keys($escapedData));
  $values = "'" . implode("', '", array_values($escapedData)) . "'";
  $query = "INSERT INTO $table ($columns) VALUES ($values)";

  $statement = mysqli_prepare($conn, $query);
  mysqli_stmt_execute($statement);

  if (mysqli_stmt_errno($statement)) {
    die("Error: " . mysqli_stmt_error($statement));
  }

  mysqli_stmt_close($statement);
  return mysqli_insert_id($conn);
}

function updateData($table, $data, $condition)
{
  global $conn;

  $table = mysqli_real_escape_string($conn, $table);

  $escapedData = array();
  foreach ($data as $column => $value) {
    $escapedColumn = mysqli_real_escape_string($conn, $column);
    $escapedValue = mysqli_real_escape_string($conn, $value);
    $escapedData[] = "$escapedColumn = '$escapedValue'";
  }

  $setClause = implode(", ", $escapedData);
  $query = "UPDATE $table SET $setClause WHERE $condition";

  $statement = mysqli_prepare($conn, $query);
  mysqli_stmt_execute($statement);

  if (mysqli_stmt_errno($statement)) {
    die("Error: " . mysqli_stmt_error($statement));
  }

  mysqli_stmt_close($statement);
}

function deleteData($table, $condition)
{
  global $conn;

  $table = mysqli_real_escape_string($conn, $table);

  $query = "DELETE FROM $table WHERE $condition";

  $statement = mysqli_prepare($conn, $query);
  mysqli_stmt_execute($statement);

  if (mysqli_stmt_errno($statement)) {
    die("Error: " . mysqli_stmt_error($statement));
  }

  mysqli_stmt_close($statement);
}

function countData($table)
{
  global $conn;

  $query = "SELECT COUNT(*) as count FROM $table";

  $statement = mysqli_prepare($conn, $query);
  mysqli_stmt_execute($statement);

  $result = mysqli_stmt_get_result($statement);
  $row = mysqli_fetch_assoc($result);

  mysqli_stmt_close($statement);
  return $row['count'];
}

function toIdr($number)
{
  return 'Rp ' . number_format($number, 2, ',', '.');
}
