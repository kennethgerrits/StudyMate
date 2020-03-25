function filterTable(table, column) {
    let url = "{{ route('postDeadlineManagerSort') }}?table=' + table + '&column=' + column'";

    if (window.location.href === url + '&order=asc' || window.location.href === url) {
        window.location = url + '&order=desc';
    } else {
        window.location = url + '&order=asc';
    }
}
