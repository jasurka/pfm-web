<?php
require_once '../../core/db_connect.php';
require_once '../../helpers.php';
$conn = OpenCon();
session_start();
$current_user     = get_user( $conn, $_SESSION );

$transactions     = get_all_transactions( $conn, $current_user['user_id'] );

$chart_transactions_expenses = array();
$chart_transactions_income = array();

foreach ( $transactions as $transaction ) {
	if ( $transaction['type'] === 'expense' ) {
		$category = get_category_by_id( $conn, $transaction['category_id'] )['name'];
		$amount   = $transaction['amount'];

		if ( ! isset( $chart_transactions_expenses[ $category ] ) ) {
			$chart_transactions_expenses[ $category ] = $amount;
		} else {
			$chart_transactions_expenses[ $category ] += $amount;
		}
	} else {
		$category = get_category_by_id( $conn, $transaction['category_id'] )['name'];
		$amount   = $transaction['amount'];

		if ( ! isset( $chart_transactions_income[ $category ] ) ) {
			$chart_transactions_income[ $category ] = $amount;
		} else {
			$chart_transactions_income[ $category ] += $amount;
		}
	}
}
echo '<pre>';
//var_dump( $chart_transactions );
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personal Finance Manager - Reports</title>
	<link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
<?php
require_once '../../templates/header.php';
?>
<div class="container">
	<div class="charts-wrapper">
		<div class="chart-item">
			<h2 class="chart-title">Total expenses</h2>
			<canvas id="transactions_expenses"></canvas>
		</div>
		<div class="chart-item">
			<h2 class="chart-title">Total income</h2>
			<canvas id="transactions_income"></canvas>
		</div>
	</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
	let transactions_expenses = JSON.parse('<?php echo json_encode($chart_transactions_expenses); ?>');
	let transactions_expenses_chart = document.getElementById('transactions_expenses');
	let transactions_expenses_total = new Chart(transactions_expenses_chart, {
		type: 'doughnut',
		data: {
			labels: Object.keys(transactions_expenses),
			datasets: [{
				label: 'Total expenses',
				data: Object.values(transactions_expenses),
				backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(255, 206, 86, 0.8)',
					'rgba(75, 192, 192, 0.8)',
					'rgba(153, 102, 255, 0.8)',
					'rgba(255, 159, 64, 0.8)',
				],
				borderWidth: 1,
				width: 800,
			}]
		}
	});

	let transactions_income = JSON.parse('<?php echo json_encode($chart_transactions_income); ?>');
	let transactions_income_chart = document.getElementById('transactions_income');
	let transactions_income_total = new Chart(transactions_income_chart, {
		type: 'doughnut',
		data: {
			labels: Object.keys(transactions_income),
			datasets: [{
				label: 'Total expenses',
				data: Object.values(transactions_income),
				backgroundColor: [
					'rgba(255, 159, 64, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(153, 102, 255, 0.8)',
					'rgba(255, 206, 86, 0.8)',
					'rgba(255, 99, 132, 0.8)',
					'rgba(75, 192, 192, 0.8)',
				],
				borderWidth: 1,
				width: 800,
			}]
		}
	});
</script>
</body>
</html>