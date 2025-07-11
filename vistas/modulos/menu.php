<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

			echo '<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>

			<li>

				<a href="clientesMorosos">

					<i class="fa fa-meh-o"></i>
					<span>Clientes Morosos</span>

				</a>

			</li>

			<li>

				<a href="clientesPagos">

					<i class="fa fa-address-card"></i>
					<span>Clientes Pagos</span>

				</a>

			</li>

			<li>

				<a href="clientesPerdidos">

					<i class="fa fa-street-view"></i>
					<span>Clientes Perdidos</span>

				</a>

			</li>

			<li>

				<a href="cobroDelDia">

					<i class="fa fa-calendar"></i>
					<span>Cobros del dia</span>

				</a>

			</li>

			<li>

				<a href="gastos">

					<i class="fa fa-sort-amount-asc"></i>
					<span>Gastos</span>

				</a>

			</li>

			<li>

				<a href="billetera">

					<i class="fa fa-credit-card-alt"></i>
					<span>Billetera</span>

				</a>

			</li>

			<li>

				<a href="banco">

					<i class="fa fa-university"></i>
					<span>Banco</span>

				</a>

			</li>

			<li>

				<a href="efectivo">

					<i class="fa fa-money"></i>
					<span>efectivo</span>

				</a>

			</li>';

		}



		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>

					<span>Prestamos</span>

					<span class="pull-right-container">

						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">';

					/*<li>

						<a href="ventas">

							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">

							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>*/

					if($_SESSION["perfil"] == "Administrador"){

					echo '<li>

						<a href="reportes">

							<i class="fa fa-circle-o"></i>
							<span>Reporte de prestamos</span>

						</a>

					</li>';

					}



				echo '</ul>

			</li>';

		}

		?>

		</ul>

	 </section>

</aside>
