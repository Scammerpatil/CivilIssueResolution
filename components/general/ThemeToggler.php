<div tabindex="0" role="button" class="btn">
    <i class="fa-regular fa-sun"></i>
    <i class="fa-solid fa-chevron-down"></i>
</div>
<ul tabindex="0" class="dropdown-content bg-base-300 rounded-box z-[1] w-52 p-2 h-52 overflow-y-auto shadow-2xl">
    <?php
    // Array of themes
    $themes = [
        "light",
        "dark",
        "cupcake",
        "bumblebee",
        "emerald",
        "corporate",
        "synthwave",
        "retro",
        "cyberpunk",
        "valentine",
        "halloween",
        "garden",
        "forest",
        "aqua",
        "lofi",
        "pastel",
        "fantasy",
        "wireframe",
        "black",
        "luxury",
        "dracula",
        "cmyk",
        "autumn",
        "business",
        "acid",
        "lemonade",
        "night",
        "coffee",
        "winter",
        "dim",
        "nord",
        "sunset",
    ];

    // Iterate over the themes array and generate list items dynamically
    foreach ($themes as $theme) {
        echo '<li>';
        echo '<input type="radio" name="theme-dropdown" class="theme-controller btn btn-sm btn-block btn-ghost justify-start" aria-label="' . ucfirst($theme) . '" value="' . $theme . '" />';
        echo '</li>';
    }
    ?>
</ul>