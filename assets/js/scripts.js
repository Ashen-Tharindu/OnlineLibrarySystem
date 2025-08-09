document.addEventListener("DOMContentLoaded", function() {
    const searchBox = document.getElementById("searchBox");
    if(searchBox){
        searchBox.addEventListener("keyup", function() {
            fetch(`index.php?controller=book&action=search&q=${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let html = "<table><tr><th>Title</th><th>Author</th><th>Category</th><th>Status</th></tr>";
                    data.forEach(book => {
                        html += `<tr>
                            <td>${book.title}</td>
                            <td>${book.author}</td>
                            <td>${book.category}</td>
                            <td>${book.available == 1 ? 'Available' : 'Borrowed'}</td>
                        </tr>`;
                    });
                    html += "</table>";
                    document.getElementById("bookResults").innerHTML = html;
                });
        });
    }
});
