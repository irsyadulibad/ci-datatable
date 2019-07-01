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
		<table class="table table-bordered" id="table-example2" data-url="<?= base_url('json/example2'); ?>">
			<thead>
				<th>Name</th>
				<th>Email</th>
				<th>Address</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<a class="btn btn-sm btn-success font-weight-bold float-right mt-4" href="<?= base_url('table/example3'); ?>">Example 3	&raquo</a>
	<a class="btn btn-sm btn-primary font-weight-bold float-left mt-4" href="<?= base_url('table/'); ?>">&laquo	Example 1</a>
</div>