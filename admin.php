<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cotización</title>
		<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
		<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
		<style>
			[x-cloak] {
				display: none;
			}
			@media print {
				.no-printme  {
					display: none;
				}
				.printme  {
					display: block;
				}
				body {
					line-height: 1.2;
				}
			}
			@page {
				size: A4 portrait;
				counter-increment: page;
			}
			/* Datepicker */
			.date-input {
				background-color: #fff;
				border-radius: 10px;
				padding: 0.5rem 1rem;
				z-index: 2000;
				margin: 3px 0 0 0;
				border-top: 1px solid #eee;
				box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
					0 4px 6px -2px rgba(0, 0, 0, 0.05);
			}
			.date-input.is-hidden {
				display: none;
			}
			.date-input .pika-title {
				padding: 0.5rem;
				width: 100%;
				text-align: center;
			}
			.date-input .pika-prev,
			.date-input .pika-next {
				margin-top: 0;
				/* margin-top: 0.5rem; */
				padding: 0.2rem 0;
				cursor: pointer;
				color: #4299e1;
				text-transform: uppercase;
				font-size: 0.85rem;
			}
			.date-input .pika-prev:hover,
			.date-input .pika-next:hover {
				text-decoration: underline;
			}
			.date-input .pika-prev {
				float: left;
			}
			.date-input .pika-next {
				float: right;
			}
			.date-input .pika-label {
				display: inline-block;
				font-size: 0;
			}
			.date-input .pika-select-month,
			.date-input .pika-select-year {
				display: inline-block;
				border: 1px solid #ddd;
				color: #444;
				background-color: #fff;
				border-radius: 10px;
				font-size: 0.9rem;
				padding-left: 0.5em;
				padding-right: 0.5em;
				padding-top: 0.25em;
				padding-bottom: 0.25em;
				appearance: none;
			}
			.date-input .pika-select-month:focus,
			.date-input .pika-select-year:focus {
				border-color: #cbd5e0;
				outline: none;
			}
			.date-input .pika-select-month {
				margin-right: 0.25em;
			}
			.date-input table {
				width: 100%;
				border-collapse: collapse;
				margin-bottom: 0.2rem;
			}
			.date-input table th {
				width: 2em;
				height: 2em;
				font-weight: normal;
				color: #718096;
				text-align: center;
			}
			.date-input table th abbr {
				text-decoration: none;
			}
			.date-input table td {
				padding: 2px;
			}
			.date-input table td button {
				/* border: 1px solid #e2e8f0; */
				width: 1.8em;
				height: 1.8em;
				text-align: center;
				color: #555;
				border-radius: 10px;
			}
			.date-input table td button:hover {
				background-color: #bee3f8;
			}
			.date-input table td.is-today button {
				background-color: #ebf8ff;
			}
			.date-input table td.is-selected button {
				background-color: #3182ce;
			}
			.date-input table td.is-selected button {
				color: white;
			}
			.date-input table td.is-selected button:hover {
				color: white;
			}
			.title_pkg {
			color: #66d2b3;
					}
		</style>
	</head>
	<body>
		<body class="antialiased sans-serif">
			<div class="border-t-8 border-gray-700 h-2"></div>
			<div
				class="container mx-auto py-6 px-4"
				x-data="invoices()"
				x-init="generateInvoiceNumber(111111, 999999);"
				x-cloak
				>
				<div class="flex justify-between">
					<img class="mb-6 pb-2 tracking-wider" src="https://xclusivetourscancun.com/logo.png" width="150" height="45">
					<div>
						<div class="relative mr-4 inline-block">
							<div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" @click="printInvoice()">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
									<path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
									<path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
									<rect x="7" y="13" width="10" height="8" rx="2" />
								</svg>
							</div>
							<div x-show.transition="showTooltip" class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
								Generar PDF!
							</div>
						</div>
						
						<div class="relative inline-block">
							<div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" @mouseenter="showTooltip2 = true" @mouseleave="showTooltip2 = false" @click="window.location.reload()">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
									<path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5" />
									<path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5" />
								</svg>
							</div>
							<div x-show.transition="showTooltip2" class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs">
								Generar otra cotización
							</div>
						</div>
					</div>
				</div>
				<h2 class="text-2xl font-bold mb-6 pb-2 tracking-wider uppercase border-b">VOUCHER</h2>
				<div class="flex flex-wrap justify-between mb-8">
					<div class="w-full md:w-1/3 mb-2 md:mb-0">
						<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">OPERADOR:</label>
						<div class="mb-2 md:mb-1 md:flex items-center">
							<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Confirmación</label>
							<span class="mr-4 inline-block hidden md:block">:</span>
							<div class="flex-1">
								<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="eg. #INV-100001" x-model="invoiceNumber">
							</div>
						</div>
						<div class="mb-2 md:mb-1 md:flex items-center">
							<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Agente</label>
							<span class="mr-4 inline-block hidden md:block">:</span>
							<div class="flex-1">
								<input id="agente" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Agente" x-model="from.agente">
							</div>
						</div>
						<div class="mb-2 md:mb-1 md:flex items-center">
							<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Fecha cotización</label>
							<span class="mr-4 inline-block hidden md:block">:</span>
							<div class="flex-1">
								<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 js-datepicker" type="text" id="datepicker1" placeholder="eg. 17 Feb, 2020" x-model="invoiceDate" x-on:change="invoiceDate = document.getElementById('datepicker1').value" autocomplete="off" readonly>
							</div>
						</div>
					</div>
					<div class="w-full md:w-1/3">
						<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">CLIENTE:</label>
						<div class="mb-2 md:mb-1 md:flex items-center">
							<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Nombre</label>
							<span class="mr-4 inline-block hidden md:block">:</span>
							<div class="flex-1">
								<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Nombre cliente" x-model="from.name">
							</div>
						</div>
						<div class="mb-2 md:mb-1 md:flex items-center">
							<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Fecha de viaje</label>
							<span class="mr-4 inline-block hidden md:block">:</span>
							<div class="flex-1">
								<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 js-datepicker-2" id="datepicker2" type="text" placeholder="eg. 17 Mar, 2020" x-model="invoiceDueDate" x-on:change="invoiceDueDate = document.getElementById('datepicker2').value" autocomplete="off" readonly>
							</div>
						</div>
						<div class="mb-2 md:mb-1 md:flex items-center">
							<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Hotel</label>
							<span class="mr-4 inline-block hidden md:block">:</span>
							<div class="flex-1">
								<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Hotel" x-model="from.hotel">
							</div>
						</div>						
						<div class="mb-2 md:mb-1 md:flex items-center">
							<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">País de origen</label>
							<span class="mr-4 inline-block hidden md:block">:</span>
							<div class="flex-1">
								<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="País" x-model="from.pais">
							</div>
						</div>
					</div>
				</div>
				<div class="flex -mx-1 border-b py-2 items-start">
					<div class="flex-1 px-1">
						<p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Tour</p>
					</div>
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Pick Up Time</p>
					</div>					
					<div class="px-1 w-20 text-right">
						<p class="text-gray-800 uppercase tracking-wide text-sm font-bold">PAX</p>
					</div>
					<div class="px-1 w-32 text-right">
						<p class="leading-none">
							<span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Precio Unitario</span>
						</p>
					</div>
					<div class="px-1 w-32 text-right">
						<p class="leading-none">
							<span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Total</span>
						</p>
					</div>
					<div class="px-1 w-20 text-center">
					</div>
				</div>
			
				<template x-for="invoice in items" :key="invoice.id">
				<div class="flex -mx-1 py-2 border-b">
					<div class="flex-1 px-1 inline-flex items-baseline">
						<p class="text-base font-bold" x-text="invoice.name"></p><p class="text-blue-800 text-xs font-semibold ml-2 px-2.5 py0.5 rounded dark:bg-blue-400 dark:text-blue-800" x-text="invoice.menor"></p>
					</div>
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" x-text="invoice.PickUp"></p>
					</div>
					<div class="px-1 w-20 text-right">
						<p class="text-gray-800" x-text="invoice.qty"></p>
					</div>
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" x-text="numberFormat(invoice.rate)"></p>
					</div>
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" x-text="numberFormat(invoice.total)"></p>
					</div>
					<div class="px-1 w-20 text-right">
						<a href="#" class="text-red-500 hover:text-red-600 text-sm font-semibold" @click.prevent="deleteItem(invoice.id)">Eliminar</a>
					</div>
				</div>
				</template>
				<button class="mt-6 bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded shadow-sm" x-on:click="openModal = !openModal">
				Agregar tour
				</button>
				<button class="mt-6 bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded shadow-sm" x-on:click="openModal2 = !openModal2">
				Agregar servicio
				</button>

				<div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4">
					<div class="py-2 border-t border-b">
						<div class="flex justify-between">
							<div class="text-xl text-gray-600 text-right flex-1">Total</div>
							<div class="text-right w-40">
								<div class="text-xl text-gray-800 font-bold" x-html="netTotal"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-4 w-52 mr-2">
										<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide" required>Estado de pago</label>
					<select id="tours" class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="from.estadopago">
						<option value="" hidden>Seleccionar...</option>
						<option value="Pago al abordar">Pago al abordar</option>
						<option value="Reservado con anticipo">Reservado con anticipo</option>
						<option value="Balance pagado">Balance pagado</option>
					</select>
				</div>
				<div class="mb-4 w-52 mr-2">
					<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide" required>Agregar observaciones (opcional)</label>
					<textarea class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" placeholder="Observaciones" x-model="from.observaciones"></textarea>
				</div>				
				<!-- Print Template -->
				<div id="js-print-template" x-ref="printTemplate" class="hidden">
					<div class="flex items-center mx-auto overflow-hidden font-medium flex-row justify-between">
						<img src="https://xclusivetourscancun.com/logo.png" width="150" height="45">
						<div class="mb-2 md:mb-0">
							<div class="flex items-center">
								<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Pago:</label>
								<span class="mr-4 inline-block">:</span>
								<div class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900" x-text="from.estadopago"></div>
							</div>
							<div class="flex items-center">
								<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Confirmación</label>
								<span class="mr-4 inline-block">:</span>
								<div x-text="invoiceNumber"></div>
							</div>
							
							<div class="flex items-center">
								<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Fecha</label>
								<span class="mr-4 inline-block">:</span>
								<div x-text="invoiceDate"></div>
							</div>
							<div class="flex items-center">
								<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Agente</label>
								<span class="mr-4 inline-block">:</span>
								<div x-text="from.agente"></div>
							</div>
						</div>
					</div>
					<section class="py-3">
						<div class=" mx-auto max-w-7xl ">
							<div class="flex flex-wrap w-full px-4 pb-3">
								<div class="w-full md:w-1/3">
									<h2 class="text-2xl font-bold mb-2 tracking-wider uppercase border-b">VOUCHER</h2>
									<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">CLIENTE:</label>
									<div class="flex items-center">
										<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Nombre</label>
										<span class="mr-4 inline-block">:</span>
										<div x-text="from.name"></div>
									</div>
									<div class="flex items-center">
										<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Fecha</label>
										<span class="mr-4 inline-block">:</span>
										<div x-text="invoiceDueDate"></div>
									</div>
									<div class="flex items-center">
										<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Hotel</label>
										<span class="mr-4 inline-block">:</span>
										<div x-text="from.hotel"></div>
									</div>
									<div class="flex items-center">
										<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">País de origen</label>
										<span class="mr-4 inline-block">:</span>
										<div x-text="from.pais"></div>
									</div>
								</div>
							</div>
							<div class="flex border-b py-2 items-start">
								<div class="flex-1 px-1">
									<p class="text-gray-800 uppercase tracking-wide text-xs font-bold">Tour</p>
								</div>
								<div class="px-1 w-32 text-right">
									<p class="text-gray-800 uppercase tracking-wide text-xs font-bold">Pick Up TIme</p>
								</div>
								<div class="px-1 w-20 text-right">
									<p class="text-gray-800 uppercase tracking-wide text-xs font-bold">PAX</p>
								</div>
								<div class="px-1 w-32 text-right">
									<p class="leading-none">
										<span class="block uppercase tracking-wide text-xs font-bold text-gray-800">Precio Unitario</span>
									</p>
								</div>
								<div class="px-1 w-32 text-right">
									<p class="leading-none">
										<span class="block uppercase tracking-wide text-xs font-bold text-gray-800">Total</span>
									</p>
								</div>
							</div>
							<template x-for="invoice in items" :key="invoice.id">
							<div class="flex flex-wrap -mx-1 py-2 border-b">
								<div class="flex-1 px-1 inline-flex items-baselin">
									<p class="text-gray-800" x-text="invoice.name"></p> <p class="text-blue-800 text-xs font-semibold ml-2 px-2.5 py0.5 rounded dark:bg-blue-400 dark:text-blue-800" x-text="invoice.menor"></p>
								</div>
								
								<div class="px-1 w-32 text-right">
									<p class="text-gray-800" x-text="invoice.PickUp"></p>
								</div>

								<div class="px-1 w-32 text-right">
									<p class="text-gray-800" x-text="invoice.qty"></p>
								</div>
								
								<div class="px-1 w-32 text-right">
									<p class="text-gray-800" x-text="numberFormat(invoice.rate)"></p>
								</div>
								
								<div class="px-1 w-32 text-right">
									<p class="text-gray-800" x-text="numberFormat(invoice.total)"></p>
								</div>
							</div>
							</template>
							<div class="py-2 ml-auto mt-3" style="width: 320px">
								<div class="py-2 border-t border-b">
									<div class="flex justify-between">
										<div class="text-xl text-gray-600 text-right flex-1">TOTAL</div>
										<div class="text-right w-40">
											<div class="text-xl text-gray-800 font-bold" x-html="netTotal"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<section class="py-1">
						<div class=" mx-auto max-w-7xl ">
							<div class="grid grid-cols-2 gap-2">
								<div>
									<h1 class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Observaciones</h1>
									<p class="text-xs text-gray-600 text-left flex-1">Estar 5 min antes en el punto de encuentro.</p>
									<pre class="text-xs text-grey-600 text-left flex-1" x-text="from.observaciones"></pre>
								</div>
								<div>
									<h1 class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Recomendaciones</h1>
									<ul>
										<li class="text-xs text-gray-600 text-left flex-1">» Cámara o celular (con protector para el agua)</li>
										<li class="text-xs text-gray-600 text-left flex-1">» Bloqueador solar</li>
										<li class="text-xs text-gray-600 text-left flex-1">» Lentes para sol</li>
										<li class="text-xs text-gray-600 text-left flex-1">» Gorra o sombrero</li>
										<li class="text-xs text-gray-600 text-left flex-1">» Dinero en efectivo extra para el impuesto del muelle y bebidas adicionales</li>
									</ul>
								</div>
							</div>
						</div>
					</section>
					<div class="flex flex-wrap -mx-1 py-1 items-start">
						<div class="flex-1 px-1">
							<b class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Condiciones</b>
							<p class="text-gray-800 italic text-left flex-1" style="font-size: 6px">
								Cancelaciones hechas 2 días o más antes del horario programado para el tour aplica un cargo de 50%. / Cancelaciones hechas de 0 a 1 días antes del horario programado para el tour aplica un cargo de 100%. /  No aplican reembolsos si no te presentas en el punto de encuentro acordado para iniciar el tour o para transportarte hasta el lugar donde tomarás el tour. / Todas las modificaciones están sujetas a disponibilidad del proveedor del servicio. / Tour en paquete se paga la totalidad al abordar la primera actividad. / Cobro del 6% adicional por pago con tarjeta de crédito o débito / Reservas de Experiencias Xcaret son con prepago 1 día antes de la actividad.
							</p>
						</div>
					</div>
					<section class=" py-3 ">
						<div class=" mx-auto max-w-7xl ">
							<div class="grid grid-cols-2 gap-2">
								<div>
									
									<div class="md:flex p-4 rounded overflow-hidden shadow-lg m-6">
										<div class="md:flex-shrink-0">
											<img class="rounded-lg md:w-56" src="expertos.jpg">
										</div>
										<div class="mt-4 md:mt-0 md:ml-6">
											<div class="uppercase tracking-wide text-sm text-green-600 font-bold">¡Expertos creando experiencias!</div>
											<p class="mt-2 text-gray-600 text-sm">Desde tours, paquetes turísticos hasta renta de autos y hoteles. ¡Lo tenemos todo!</p>
											<p class="mt-2 text-gray-600 text-sm">» Pregunta por nuestras promociones y reserva sin ningún costo.</p>											
										</div>
									</div>
								</div>
								<div>
									<div class="md:flex p-4 rounded overflow-hidden shadow-lg m-6">
										<div class="md:flex-shrink-0">
											<img class="rounded-lg md:w-56" src="taxi.jpg">
										</div>
										<div class="mt-4 md:mt-0 md:ml-6">
											<div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">¿Necesitas traslados?</div>
											<p class="mt-2 text-gray-600 text-sm">Transportación privada del Aeropuerto - Hotel Cancún, Playa del Carmen y Riviera Maya</p>
											<p class="mt-2 text-gray-600 text-sm">» ¿Pensando en rentar un auto? Renta tu auto desde $900 pesos por día</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<section>
						<div class="text-center max-w-7xl mx-auto">
							<p class="w-4/5 mx-auto my-5 md:w-3/5 lg:w-2/5" style="font-size: 8px">Cancún Q. Roo Edificio Siglo XXI, Oficina 208 | Tel +52 998 348 2030<br/>Email: ventasxclusivetour1@gmail.com | <b>Registro Nacional de Turismo:</b> 04230051276</p>
						</div>
					</section>
				</div>
				<!-- /Print Template -->
				<!-- Modal tours -->
				<div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openModal">
					<div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
						<div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
							x-on:click="openModal = !openModal">
							<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path
									d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
								</svg>
							</div>
							<div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
								
								<h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Agrega un tour</h2>
								
								<div class="mb-4">
									<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Tour</label>
									<select id="tours" class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="item.name">
										<option value="" hidden>Seleccionar...</option>
										<option value="Tour Xcaret Plus">Tour Xcaret Plus</option>
										<option value="Tour Xel-Ha">Tour Xel-Ha</option>
										<option value="Tour Xoximilco">Tour Xoximilco</option>
										<option value="Tour Xplor Día">Tour Xplor Día</option>
										<option value="Tour Xplor Fuego">Tour Xplor Fuego</option>
										<option value="Tour Xenses">Tour Xenses</option>
										<option value="Tour Xavage All-Inclusive">Tour Xavage All-Inclusive</option>
										<option value="Tour Chichén Clásico">Tour Chichén Clásico</option>
										<option value="Tour Chichen Plus">Tour Chichen Plus</option>
										<option value="Tour Isla Mujeres">Tour Isla Mujeres</option>
										<option value="Tour Cozumel + Club de Playa">Tour Cozumel + Club de Playa</option>
										<option value="Holbox Plus">Holbox Plus</option>
										<option value="Tour Tulum Casa Tortuga">Tour Tulum Casa Tortuga</option>
										<option value="Tour Isla Contoy">Tour Isla Contoy</option>
										<option value="5x1 Tulum">5x1 Tulum</option>
										<option value="Bacalar + Paseo en lancha">Bacalar + Paseo en lancha</option>
									</select>
								</div>
								<div class="flex">
									<div class="mb-4 w-32 mr-2">
										<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide" required>PAX</label>
										<input type="number" class="text-right mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" x-model="item.qty">
									</div>
									<div class="mb-4 w-32 mr-2">
										<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Precio</label>
										<input class="text-right mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" x-model="item.rate">
									</div>
									<div class="mb-4 w-32">
										<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Total</label>
										<input class="text-right mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" x-model="item.total = item.qty * item.rate">
									</div>
								</div>
								<div class="flex">
									<div class="flex">
										<div class="mb-4 w-52 mr-2">
											<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide" required>¿Es menor?</label>
											<select id="tours" class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="item.menor">
												<option value="" hidden>Seleccionar...</option>
												<option value="&#160;">No</option>
												<option value="Precio de menores">Si</option>
											</select>
										</div>
									</div>
									<div class="flex">
										<div class="mb-4 w-52 mr-2">
											<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide" required>Hora del PickUp (24hrs)</label>
										<input class="text-right mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="time" x-model="item.PickUp">
										</div>
									</div>	
								</div>							
								<div class="mt-8 text-right">
									<button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded shadow-sm mr-2" @click="openModal = !openModal">
									Cancelar
									</button>
									<button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded shadow-sm" @click="addItem()">
									Agregar tour
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Modal Tours -->
				<!-- Modal servicios -->
				<div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openModal2">
					<div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
						<div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
							x-on:click="openModal2 = !openModal2">
							<svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path
									d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
								</svg>
							</div>
							<div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
								
								<h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Agrega un servicio</h2>
								
								<div class="mb-4">
									<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Servicio</label>
									<select id="tours" class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="item.name">
										<option value="" hidden>Seleccionar...</option>
										<option value="Servicio de Transportación">Servicio de Transportación</option>
										<option value="Renta de Kia Río 2022">Renta de Kia Río 2022</option>
										<option value="Servicio de Tour Privado">Servicio de Tour Privado</option>
										<option value="Chichen Delux">Chichen Delux</option>
									</select>
								</div>
								<div class="flex">
									<div class="mb-4 w-42 mr-2">
										<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">PAX (coloca sólo 1)</label>
										<input type="number" min="1" max="1" class="text-right mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" x-model="item.qty">
									</div>									
									<div class="flex">
										<div class="mb-4 w-32 mr-2">
											<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide" required>PICKUP</label>
										<input class="text-right mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="time" x-model="item.PickUp">
										</div>
									</div>
									<div class="mb-4 w-32 mr-2">
										<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Total</label>
										<input class="text-right mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" x-model="item.rate">
									</div>																			
								</div>						
								<div class="mt-8 text-right">
									<button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded shadow-sm mr-2" @click="openModal2 = !openModal2">
									Cancelar
									</button>
									<button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded shadow-sm" @click="addItem()">
									Agregar servicio
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Modal Servicio -->
				</div>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
				<script>
				window.addEventListener('DOMContentLoaded', function() {
						const today = new Date();
					
				var picker = new Pikaday({
							keyboardInput: false,
							field: document.querySelector('.js-datepicker'),
							format: 'D MMM YYYY',
							theme: 'date-input',
							i18n: {
								previousMonth: "Prev",
								nextMonth: "Next",
								months: [
									"Ene",
									"Feb",
									"Mar",
									"Abr",
									"May",
									"Jun",
									"Jul",
									"Ago",
									"Sep",
									"Oct",
									"Nov",
									"Dic"
								],
								weekdays: [
									"Domingo",
									"Lunes",
									"Martes",
									"Miércoles",
									"Jueves",
									"Viernes",
									"Sábado"
								],
								weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"]
							}
						});
						picker.setDate(new Date());
						var picker2 = new Pikaday({
							keyboardInput: false,
							field: document.querySelector('.js-datepicker-2'),
							format: 'MMM D YYYY',
							theme: 'date-input',
							i18n: {
								previousMonth: "Prev",
								nextMonth: "Next",
								months: [
									"Jan",
									"Feb",
									"Mar",
									"Apr",
									"May",
									"Jun",
									"Jul",
									"Aug",
									"Sep",
									"Oct",
									"Nov",
									"Dec"
								],
								weekdays: [
									"Domingo",
									"Lunes",
									"Martes",
									"Miercoles",
									"Jueves",
									"Viernes",
									"Sabado"
								],
								weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"]
							}
						});
						picker2.setDate(new Date());
					});
					function invoices() {
						return {
							items: [],
							invoiceNumber: 0,
							invoiceDate: '',
							invoiceDueDate: '',
							totalGST: 0,
							netTotal: 0,
							item: {
								id: '',
								name: '',
								description: '',
								qty: 0,
								rate: 0,
								total: 0,
								gst: 18
							},
							billing: {
								name: '',
								address: '',
								extra: ''
							},
							from: {
								name: '',
								address: '',
								extra: ''
							},
							showTooltip: false,
							showTooltip2: false,
							openModal: false,
							openModal2: false,							
							addItem() {
								this.items.push({
									id: this.generateUUID(),
									name: this.item.name,
									menor: this.item.menor,
									PickUp: this.item.PickUp,
									estadopago: this.item.estadopago,
									observaciones: this.item.observaciones,
									eltotal: this.item.eltotal,									
									qty: this.item.qty,
									rate: this.item.rate,
									gst: this.calculateGST(this.item.gst, this.item.rate),
									total: this.item.qty * this.item.rate
								})
								this.itemTotal();
								this.itemTotalGST();
								this.item.id = '';
								this.item.name = '';
								this.item.menor = '';
								this.item.qty = 0;
								this.item.rate = 0;
								this.item.gst = 18;
								this.item.total = 0;
								this.item.eltotal = 0;																
							},
							deleteItem(uuid) {
								this.items = this.items.filter(item => uuid !== item.id);
								this.itemTotal();
								this.itemTotalGST();
							},
							itemTotal() {
								this.netTotal = this.numberFormat(this.items.length > 0 ? this.items.reduce((result, item) => {
									return result + item.total;
								}, 0) : 0);
							},
							itemTotalGST() {
				this.totalGST =  this.numberFormat(this.items.length > 0 ? this.items.reduce((result, item) => {
									return result + (item.gst * item.qty);
								}, 0) : 0);
							},
							calculateGST(GSTPercentage, itemRate) {
								return this.numberFormat((itemRate - (itemRate * (100 / (100 + GSTPercentage)))).toFixed(2));
							},
							generateUUID() {
								return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
									var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
									return v.toString(16);
								});
							},
							generateInvoiceNumber(minimum, maximum) {
								const randomNumber = Math.floor(Math.random() * (maximum - minimum)) + minimum;
								this.invoiceNumber = '#INV-'+ randomNumber;
							},
							numberFormat(amount) {
								return amount.toLocaleString("en-US", {
									style: "currency",
									currency: "USD"
								});
							},
							printInvoice() {
								var printContents = this.$refs.printTemplate.innerHTML;
								var originalContents = document.body.innerHTML;
								document.body.innerHTML = printContents;
								window.print();
								document.body.innerHTML = originalContents;
							}
						}
					}
				</script>
				<script language="javascript">
				 document.title = "Cotización_"+Date.now();
				</script>				
			</body>
		</body>
	</html>
