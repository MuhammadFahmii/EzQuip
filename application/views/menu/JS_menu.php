<script>
  document.addEventListener("DOMContentLoaded", function(e) {
    // Autofocus Modal
    $("#menu-modal").on("shown.bs.modal", function() {
      $("#nama-menu").trigger("focus");
    });

    /**
     * Function for datatable configuration
     */
    const table = $(`#menu-table`).DataTable({
      responsive: true,
      autoWidth: false,
      processing: true,
      serverSide: true,
      // get data with ajax
      ajax: {
        url: "menuManagement/generateDatatableMenu",
        header: "application/json",
        type: "POST",
      },
      columns: [{
          data: null,
        },
        {
          data: "menu",
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
    fd.append("menu", "");

    /**
     * Function for handle event click
     */
    document.addEventListener("click", function(e) {
      const title = document.querySelector(".modal-title");
      const input = document.querySelector("#nama-menu");
      const button = document.querySelector('button[type="submit"]');
      const idMenu = document.querySelector("#id-menu");
      if (e.target.id == "add-menu") {
        title.innerHTML = "Add Menu";
        button.innerHTML = "Add";
        idMenu.removeAttribute("value");
        input.value = "";
      } else if (e.target.id == "edit-menu") {
        const url = e.target.href.split("/");
        const id = url[url.length - 1];
        idMenu.value = id;
        title.innerHTML = "Edit Menu";
        button.innerHTML = "Edit";
        fetch(`<?= base_url('menu/menuManagement/getMenuById/') ?>${id}`)
          .then((res) => res.json())
          .then((data) => {
            input.value = data.menu;
          });
      } else if (e.target.id == "delete-menu") {
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
              location.reload();
            });
          }
        });
      } else if (e.target.id == "submit") {
        e.preventDefault();
        if (button.innerHTML == "Add") {
          fd.set("menu", input.value);
          fetch(`<?= base_url('menu/insertMenu') ?>`, {
              method: "POST",
              body: fd,
            })
            .then((response) => response.json())
            .then((data) => {
              if (data.status == "failed") throw new Error(data.message);
              table.ajax.reload();
              $("#menu-modal").modal("hide");
              Swal.fire({
                title: 'Success',
                text: 'Data added sucsessfully',
                icon: 'success'
              })
            })
            .catch((Error) => {
              Swal.fire({
                title: "Failed",
                text: Error,
                icon: "error",
              });
            });
        } else if (button.innerHTML == "Edit") {
          fd.set("id", idMenu.value);
          fd.set("menu", input.value);
          fetch(`<?= base_url('menu/editMenu') ?>`, {
              method: "POST",
              body: fd,
            })
            .then((response) => response.json())
            .then((data) => {
              if (data.status == "failed") throw new Error(data.message);
              location.reload();
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