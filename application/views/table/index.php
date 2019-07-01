<!--
- Source code by: Ahmad Irsyadul Ibad
- Visit my site on: http://irsyadulibad.cf (if still available)
- Github: https://github.com/irsyadulibad

- Silahkan dikembangkan agar lebih baik kedepannya
- Jangan Lupa *Berkarya* :D
-->
<div class="container">
	<h5 class="mt-2 text-center">Server Side Datatable dengan CodeIgniter</h5>
	<div class="table-responsive mt-4">
		<table class="table table-bordered" id="table-example1" data-url="<?= base_url('json/example1'); ?>">
			<thead>
				<th>Name</th>
				<th>Email</th>
				<th>Address</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<div class="mt-3">
		<a class="btn btn-sm btn-success font-weight-bold float-right mt-4" href="<?= base_url('table/example2'); ?>">Example 2	&raquo</a>
		<a class="btn btn-sm btn-primary font-weight-bold float-left mt-4" href="<?= base_url('table/example3'); ?>">&laquo	Example 3</a>
	</div>
</div>