<?php

$current_user     = get_user( $conn, $_SESSION );
?>
<div class="header">
	<div class="container">
		<div class="header-wrapper">
			<div class="logo">
				<h1>pfm</h1>
			</div>
			<div class="main-menu">
				<ul>
					<li class="menu-item"><a href="/dashboard/" class="menu-link">Dashboard</a></li>
					<li class="menu-item"><a href="/dashboard/transactions/" class="menu-link">Transactions</a></li>
					<li class="menu-item"><a href="/dashboard/budgets/" class="menu-link">Budgets</a></li>
					<li class="menu-item"><a href="/dashboard/categories/" class="menu-link">Categories</a></li>
					<li class="menu-item"><a href="/dashboard/accounts/" class="menu-link">Accounts</a></li>
					<li class="menu-item"><a href="/dashboard/reports/" class="menu-link">Reports</a></li>
				</ul>
			</div>
			<div class="user">
				Hello, <span class="username"><?php echo $current_user['username']; ?>!</span>
			</div>
		</div>
	</div>
</div>