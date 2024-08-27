jQuery(document).ready(function($) {
    // Initialize DataTables
    $('#cgp-course-table').DataTable({
        "order": []
    });

    // Handle send report button click
    $('#cgp-send-report').on('click', function() {
        let availableCount = 0;
        $('#cgp-course-table tbody tr').each(function() {
            let state = $(this).find('td').eq(3).text();
            if (state === 'available') {
                availableCount++;
            }
        });
        alert('Number of available courses: ' + availableCount);
    });
});