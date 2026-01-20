<script>
    const stars = document.querySelectorAll('.star-rating span');
    const input = document.getElementById('min_rating');
    const currentRating = input.value;

    function setStars(rating) {
        stars.forEach(star => {
            star.classList.toggle('active', star.dataset.value <= rating);
        })
    }

    // عند التحميل (في حال كان هناك فلتر سابق)
    if (currentRating) {
        setStars(currentRating);
    }

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.dataset.value;
            input.value = value;
            setStars(value);
        })
    });
</script>
