<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This user's data will be permanently removed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5', // Warna Indigo sesuai tombol Create kamu
            cancelButtonColor: '#1f2937',  // Warna gelap
            confirmButtonText: 'Yes, delete it!',
            background: '#1f2937',         // Background gelap sesuai dashboard
            color: '#ffffff',              // Teks putih
            iconColor: '#f87171'           // Warna merah untuk icon warning
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik OK, submit form-nya
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
</script>