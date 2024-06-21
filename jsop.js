document.getElementById('submitReview').addEventListener('click', function() {
    const rating = document.getElementById('rating').value;
    const opinion = document.getElementById('opinion').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'submitReview.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            loadReviews();
        }
    };
    xhr.send('rating=' + rating + '&opinion=' + opinion);
});

function loadReviews() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'getReviews.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('opinion-list').innerHTML = this.responseText;
        }
    };
    xhr.send();
}

document.addEventListener('DOMContentLoaded', loadReviews);