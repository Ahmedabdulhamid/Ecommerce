
@livewire('front.header')
<script>
    function toggleSubMenu(anchor) {
        const hiddenDiv = anchor.parentElement.querySelector('.dropdown-hidden-text');
        if (hiddenDiv.style.display === "none") {
            hiddenDiv.style.display = "block";

        } else {
            hiddenDiv.style.display = "none";
        }
    }
</script>
