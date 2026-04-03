<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=page_info" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_forward" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=keyboard_arrow_down" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=swap_vert" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_downward" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=close" />
    
<section class="catalog-filter">
    <div class="filter">
        <div class="filter__mobile"> <span class="material-symbols-outlined">
                page_info
            </span>

        <span class="material-symbols-sharp">
arrow_forward
</span>
        </div>
        <button class="mobile-filter-btn" style="background: none; border: none; font-size: 16px; cursor: pointer;">Фильтры</button>
    </div>
    <div class="filter-left">

        <div class="filter-item">
            <div class="item">
                <button class="filter-btn">
                    Тип квартиры <span class="material-symbols-outlined">
                        keyboard_arrow_down
                    </span>

            </div>

            <div class="filter-dropdown">
                <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> Студия</label>
                <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> Однокомнатная</label>
                <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> Двухкомнатная</label>
                <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> Трехкомнатная</label>
            </div>

        </div>

        <div class="filter-item">
            <div class="item">
                <button class="filter-btn">
                    Кол-во гостей <span class="material-symbols-outlined">
                        keyboard_arrow_down
                    </span>

                    <div class="filter-dropdown">
                        <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> 2</label>
                        <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> 3</label>
                        <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> 4</label>
                        <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> 5</label>
                        <label style="margin-bottom: 0px;"><input type="checkbox" style="width: auto; box-shadow: none;"> 6 и более</label>
                    </div>

            </div>

        </div>
    </div>


    <div class="filter-right">

        <div class="filter-item">
            <div class="item">
                <button class="filter-btn"> <span class="material-symbols-sharp">
swap_vert
</span>
                    
                    Сортировка <span class="material-symbols-outlined">
                        keyboard_arrow_down
                    </span>
                </button>


                <div class="filter-dropdown">

                    <label style="margin-bottom: 0px;">
                        <input type="radio" name="sort" style="width: auto; box-shadow: none;">
                        Популярное
                    </label>

                    <label style="margin-bottom: 0px;">
                        <input type="radio" name="sort" style="width: auto; box-shadow: none;">
                        Дешевле
                    </label>

                    <label style="margin-bottom: 0px;">
                        <input type="radio" name="sort" style="width: auto; box-shadow: none;">
                        Дороже
                    </label>

                </div>

            </div>

        </div>
        <button class="apply-filter">
            Применить
        </button>
    </div>


</section>

<script>
    const filters = document.querySelectorAll(".filter-btn")

    filters.forEach(btn => {

        btn.addEventListener("click", () => {

            const dropdown = btn.nextElementSibling

            document.querySelectorAll(".filter-dropdown").forEach(menu => {

                if (menu !== dropdown) {
                    menu.style.display = "none"
                }

            })

            dropdown.style.display =
                dropdown.style.display === "block" ?
                "none" :
                "block"

        })

    })
</script>