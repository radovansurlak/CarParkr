
<?php
include('class_request/class_request.php');
include('garageNames.php');

$includedClass = new Request();

$variable = $includedClass->getFile("http://www.odaa.dk/api/action/datastore_search?resource_id=2a82a145-0195-4081-a13c-b0e587e9b89c");

$decoded = json_decode($variable);

$list = $decoded->result->records;

$omfg = array();



foreach ($list as $key) {
  foreach ($garageNames as $key2) {
    if ($key->garageCode == $key2["garageCode"]) {
      $mini_array = array();
      $mini_array["name"] = $key2["garageName"];
      $mini_array["data"] = $key;
      array_push($omfg,$mini_array);
    }
  };
};

$free_list = array();

foreach ($omfg as $key => $row)
{
    $free_list[$key] = $row['data']->vehicleCount / $row['data']->totalSpaces  ;
}

array_multisort($free_list, SORT_ASC, $omfg);

foreach ($omfg as $omg) {

$spaces = $omg["data"]->totalSpaces;
$occupied = $omg["data"]->vehicleCount;
$free = $spaces - $occupied;
$name = $omg["name"];
$level = round(($occupied / $spaces)*100);

if ($level<33) {
  $class = "low";
} elseif ($level<66) {
  $class = "med";
} else {
  $class = "high";
};

?>

<article class="card">

  <h2 class="title">
    <?php echo $name?>
  </h2>

  <div class="bar">
    <div class="indicator <?php echo $class ?>" style="width:<?php echo $level?>%"></div>
  </div>

  <dl class="stats">
      <dt><?php echo $occupied?></dt>
      <dd>Occupied</dd>
    </dl>
  <dl class="stats">
      <dt><?php echo $spaces?></dt>
      <dd>Capacity</dd>
    </dl>
  <dl class="stats">
      <dt><?php echo $free?></dt>
      <dd>Free</dd>
    </dl>
</article>

<?php
};
?>
