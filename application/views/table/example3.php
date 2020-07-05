<!--
- Source code by: Ahmad Irsyadul Ibad
- Visit my site on: http://irsyadulibad.my.id
- Github: https://github.com/irsyadulibad

- Silahkan dikembangkan agar lebih baik kedepannya
- Jangan Lupa *Berkarya* :D
-->
<div class="container">
	<h5 class="mt-2 text-center">Server Side Datatable dengan CodeIgniter</h5>
	<div class="table-responsive mt-4">
		<table class="table table-bordered" id="table-example3" data-url="<?= base_url('json/example3'); ?>">
			<thead>
				<th>Name</th>
				<th>Address</th>
				<th>Action</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<a class="btn btn-sm btn-success font-weight-bold float-right mt-4" href="<?= base_url('table/'); ?>">Example 4	&raquo</a>
	<a class="btn btn-sm btn-primary font-weight-bold float-left mt-4" href="<?= base_url('table/example2'); ?>">&laquo	Example 2</a>
</div>
