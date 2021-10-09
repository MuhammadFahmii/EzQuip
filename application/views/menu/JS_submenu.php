<script>
  document.addEventListener("DOMContentLoaded", function(e) {
    const title = document.querySelector(".modal-title");
    const idSubmenu = document.querySelector("#id-submenu");
    const name = document.querySelector("#name");
    const menuId = document.querySelector("#menu-id");
    const urlSubmenu = document.querySelector("#url");
    const icon = document.querySelector("#icon");
    const isActive = document.querySelector("#is-active");
    const button = document.querySelector('button[type="submit"]');
    /**
     * Function for autofocus modal
     */
    $("#submenu-modal").on("shown.bs.modal", function() {
      $("#title").trigger("focus");
    });

    /**
     * Function for datatable configuration
     */
    const table = $(`#submenu-table`).DataTable({
      responsive: true,
      autoWidth: false,
      processing: true,
      serverSide: true,
      // get data with ajax
      ajax: {
        url: "SubmenuManagement/generateDatatable",
        header: "application/json",
        type: "POST",
      },
      columns: [{
          data: null,
        },
        {
          data: "name",
        },
        {
          data: "menu",
        },
        {
          data: "url",
        },
        {
          data: "icon",
        },
        {
          data: "is_active",
          render: function(data, type, row) {
            if (data == 1) return "Yes";
            return "No";
          }
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
    fd.append("id_submenu", 0);
    fd.append("menu_id", "");
    fd.append("name", "");
    fd.append("url", "");
    fd.append("icon", "");
    fd.append("is_active", "");

    /**
     * Function for handle event click
     */
    document.addEventListener("click", function(e) {
      if (e.target.id == "add-submenu") {
        title.innerHTML = "Add SubMenu";
        button.innerHTML = "Add";
        idSubmenu.value = 0;
        name.value = '';
        menuId.selectedIndex = 0;
        urlSubmenu.value = '';
        icon.value = '';
        isActive.removeAttribute('checked');
        isActive.setAttribute('value', 0);
      } else if (e.target.id == "edit-submenu") {
        const url = e.target.href.split("/");
        const id = url[url.length - 1];
        idSubmenu.value = id;
        title.innerHTML = "Edit SubMenu";
        button.innerHTML = "Edit";
        fetch(`<?= base_url('menu/SubmenuManagement/getMenuById/') ?>${id}`)
          .then((res) => res.json())
          .then((data) => {
            idSubmenu.value = id;
            name.value = data.name;
            menuId.selectedIndex = data.menu_id;
            urlSubmenu.value = data.url;
            icon.value = data.icon;
            if (data.is_active == 1) {
              isActive.setAttribute('value', 1)
              isActive.setAttribute('checked', 'checked');
            } else {
              isActive.removeAttribute('checked');
              isActive.setAttribute('value', 0)
            }

          });
      } else if (e.target.id == "delete-submenu") {
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
      } else if (e.target == button) {
        e.preventDefault();
        if (button.innerHTML == "Add") {
          fd.set("menu_id", menuId.value);
          fd.set("name", name.value);
          fd.set("url", urlSubmenu.value);
          fd.set("icon", icon.value);
          fd.set("is_active", isActive.getAttribute('value'));
          fetch(`<?= base_url('menu/SubmenuManagement/insert') ?>`, {
              method: "POST",
              body: fd,
            })
            .then((response) => response.json())
            .then((data) => {
              if (data.message) throw new Error(data.message);
              Swal.fire({
                title: 'Success',
                text: 'Data added sucsessfully',
                icon: 'success'
              }).then(() => {
                location.reload();
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
          fd.set("id_submenu", idSubmenu.value);
          fd.set("menu_id", menuId.value);
          fd.set("name", name.value);
          fd.set("url", urlSubmenu.value);
          fd.set("icon", icon.value);
          fd.set("is_active", isActive.getAttribute('value'));
          fetch(`<?= base_url('menu/SubmenuManagement/update') ?>`, {
              method: "POST",
              body: fd,
            })
            .then((response) => response.json())
            .then((data) => {
              if (data.message) throw new Error(data.message);
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
      } else if (e.target == isActive) {
        if (isActive.getAttribute('value') == 0) {
          isActive.setAttribute('checked', 'checked');
          isActive.setAttribute('value', 1);
        } else {
          isActive.removeAttribute('checked');
          isActive.setAttribute('value', 0);
        }
      }
    });
  });
</script>