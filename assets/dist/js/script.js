/**
 * Sweet Alert 2
 * untuk menghandle flashdata
 */
const flashDataType = $(".flash-data").data("type");
const flashData = $(".flash-data").data("flashdata");
if (flashDataType == "success") {
	Swal.fire({
		title: "Success",
		text: flashData,
		icon: "success",
	});
} else if (flashDataType == "failed") {
	Swal.fire({
		title: "Failed",
		text: flashData,
		icon: "error",
	});
}

/**
 * Handle Tombol Logout
 */
const logout = document.querySelectorAll(".logout");
logout.forEach((btn) => {
	btn.addEventListener("click", (e) =>
		clickTmb(e, "Logout", "Are you sure want to logout?")
	);
});

/**
 * Handle ketika click tombol
 */
function clickTmb(e, title, text) {
	e.preventDefault();
	const href = e.target.href;
	Swal.fire({
		title,
		text,
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "No",
		confirmButtonText: "Yes",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
}

/**
 * Function for change access role
 */
const checkAcc = document.querySelectorAll(".checkAcc");
checkAcc.forEach((i) => {
	i.addEventListener("click", async function () {
		const roleId = i.getAttribute("data-role");
		const menuId = i.getAttribute("data-menu");
		const fd = new FormData();
		fd.append("roleId", roleId);
		fd.append("menuId", menuId);
		try {
			await fetch("http://localhost/website/ci-app/admin/changeAccess", {
				method: "POST",
				body: fd,
			});
			location.reload();
		} catch (e) {
			console.log(e);
		}
	});
});
