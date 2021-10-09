<script>
	document.addEventListener("DOMContentLoaded", function(e) {
		// Autofocus Modal
		$("#roleModal").on("shown.bs.modal", function() {
			$("#namaRole").trigger("focus");
		});

		/**
		 * Function for datatable configuration
		 */
		const table = $(`#table-role`).DataTable({
			responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
			// get data with ajax
			ajax: {
				url: "generateDatatable",
				header: "application/json",
				type: "POST",
			},
			columns: [{
					data: null,
				},
				{
					data: "role",
				},
				{
					data: "action",
				},
			],
			columnDefs: [{
				searchable: false,
				orderable: false,
				targets: 0,
			}, ],
			order: [
				[1, "asc"]
			],
		});

		/**
		 * Function for indexing column datatable
		 */
		table.on("draw.dt", function() {
			const info = table.page.info();
			table
				.column(0, {
					search: "applied",
					order: "applied",
				})
				.nodes()
				.each(function(cell, i) {
					cell.innerHTML = i + 1 + info.start;
				});
		});

		/**
		 * Fill form data for Create and Update Method
		 */
		const fd = new FormData();
		fd.append("id", 0);
		fd.append("role", "");

		/**
		 * Function for handle event click
		 */
		document.addEventListener("click", function(e) {
			const title = document.querySelector(".modal-title");
			const input = document.querySelector("#namaRole");
			const button = document.querySelector('button[type="submit"]');
			const idRole = document.querySelector("#id-role");
			if (e.target.id == "add-role") {
				title.innerHTML = "Add New Role";
				button.innerHTML = "Add";
				idRole.removeAttribute("value");
				input.value = "";
			} else if (e.target.id == "edit-role") {
				const url = e.target.href.split("/");
				const id = url[url.length - 1];
				idRole.value = id;
				title.innerHTML = "Edit Role";
				button.innerHTML = "Edit";
				fetch(`<?= base_url('admin/getRole/') ?>${id}`)
					.then((res) => res.json())
					.then((data) => {
						input.value = data.role;
					});
			} else if (e.target.id == "hapus-role") {
				e.preventDefault();
				Swal.fire({
					title: "Are you sure?",
					text: "You wont be able to revert this",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					cancelButtonText: "No",
					confirmButtonText: "Yes",
					preConfirm: () => {
						fetch(e.target.href)
							.then((res) => res.json())
							.catch((err) => console.log(err));
					},
				}).then((result) => {
					if (result.value) {
						Swal.fire({
							title: "Deleted",
							text: "Data has been deleted",
							icon: "success",
						}).then(() => {
							table.ajax.reload();
						});
					}
				});
			} else if (e.target.id == "submit") {
				e.preventDefault();
				if (button.innerHTML == "Add") {
					fd.set("role", input.value);
					fetch(`<?= base_url('admin/tambahRole') ?>`, {
							method: "POST",
							body: fd,
						})
						.then((response) => response.json())
						.then((data) => {
							if (data.status == "failed") throw new Error(data.message);
							table.ajax.reload();
							$("#roleModal").modal("hide");
						})
						.catch((Error) => {
							Swal.fire({
								title: "Failed",
								text: Error,
								icon: "error",
							});
						});
				} else if (button.innerHTML == "Edit") {
					fd.set("id", idRole.value);
					fd.set("role", input.value);
					fetch(`<?= base_url('admin/editRole') ?>`, {
							method: "POST",
							body: fd,
						})
						.then((response) => response.json())
						.then((data) => {
							if (data.status == "false") throw new Error(data.message);
							table.ajax.reload();
							$("#roleModal").modal("hide");
						})
						.catch((Error) => {
							Swal.fire({
								title: "Failed",
								text: Error,
								icon: "error",
							});
						});
				}
			}
		});
	});
</script>