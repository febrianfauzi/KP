const flashData = $('.flash-data').data('flashdata');
const content = $('.m-content').data('content');

if (flashData) {
	Swal.fire({
		title: 'Data ' + content,
		text: 'Berhasil ' + flashData,
		icon: 'success'
	});
}
//tombol hapus
$('.tombol-hapus').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Data " + content + " akan dihapus",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus data!'
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	})
});

$(document).ready(function () {
	$(document).on('click', '#detguru', function () {
		var email = $(this).data('email');
		var alamat = $(this).data('alamat');
		var nama = $(this).data('nama_guru');
		var kelas = $(this).data('kelas');
		var nip = $(this).data('nip');
		$('.modal-body #nip').text(nip);
		$('.modal-body #nama').text(nama);
		$('.modal-body #kelas').text(kelas);
		if (!email) {
			$('.modal-body #email').html('<span style="color:red;">Belum diisi</span>');
		} else {
			$('.modal-body #email').text(email);
		}

		if (!alamat) {
			$('.modal-body #alamat').html('<span style="color:red;">Belum diisi</span>');
		} else {
			$('.modal-body #alamat').text(alamat);
		}
	})
});

$(document).ready(function () {
	$(document).on('click', '#editguru', function () {
		var id = $(this).data('id');
		var nip = $(this).data('nip');
		var nama = $(this).data('nama');
		var id_kelas = $(this).data('id_kelas');
		var email = $(this).data('email');
		var alamat = $(this).data('alamat');
		$('.modal-body #id').val(id);
		$('.modal-body #nip').val(nip);
		$('.modal-body #nama').val(nama);
		$('.modal-body #id_kelas').val(id_kelas);
		$('.modal-body #email').val(email);
		$('.modal-body #alamat').val(alamat);
	})
});

$(document).ready(function () {
	$(document).on('click', '#detsiswa', function () {
		var nis = $(this).data('nis');
		var nama = $(this).data('nama');
		var kelas = $(this).data('kelas');
		var email = $(this).data('email');
		var alamat = $(this).data('alamat');
		$('.modal-body #nis').text(nis);
		$('.modal-body #nama').text(nama);
		$('.modal-body #kelas').text(kelas);
		if (!email) {
			$('.modal-body #email').html('<span style="color:red;">Belum diisi</span>');
		} else {
			$('.modal-body #email').text(email);
		}

		if (!alamat) {
			$('.modal-body #alamat').html('<span style="color:red;">Belum diisi</span>');
		} else {
			$('.modal-body #alamat').text(alamat);
		}
		document.getElementById("siswa").value = nis;
	})
});

$(document).ready(function () {
	$(document).on('click', '#editsiswa', function () {
		var id = $(this).data('id');
		var nis = $(this).data('nis');
		var nama = $(this).data('nama');
		var id_kelas = $(this).data('id_kelas');
		var email = $(this).data('email');
		var alamat = $(this).data('alamat');
		$('.modal-body #id').val(id);
		$('.modal-body #nis').val(nis);
		$('.modal-body #nama').val(nama);
		$('.modal-body #id_kelas').val(id_kelas);
		$('.modal-body #email').val(email);
		$('.modal-body #alamat').val(alamat);
	})
});
