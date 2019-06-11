<?php
/*$perpage = 2;
if (isset($_GET['page']) & !empty($_GET['page'])) {
    $curpage = $_GET['page'];
} else {
    $curpage = 1;
}

$ReadSql = "SELECT * FROM crud LIMIT 0, 2";
$start = ($curpage * $perpage) - $perpage;


$PageSql = "SELECT * FROM `crud`";
$pageres = mysqli_query($connection, $PageSql);
$totalres = mysqli_num_rows($pageres);

$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;

*/

?>

<ul class="pagination ml-4">
    <li class="page-item">
        <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">First</span>
        </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Last</span>
        </a>
    </li>
</ul>
