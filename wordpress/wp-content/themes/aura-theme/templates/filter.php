
<section class="catalog-filter">
    <div class="filter">
        <div class="filter__mobile"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/page_info.svg" alt="Инфо">

        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_forward.svg" alt="Стрелка" style="vertical-align: middle">
        </div>
        <button class="mobile-filter-btn" style="background: none; border: none; font-size: 16px; cursor: pointer;">Фильтры</button>
    </div>
    <div class="filter-left">

        <div class="filter-item">
            <div class="item">
                <button class="filter-btn">
                    Тип квартиры <img src="<?php echo get_template_directory_uri(); ?>/assets/images/keyboard_arrow_down.svg" alt="Стрелка" style="vertical-align: middle">
                </button>
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
                    Кол-во гостей <img src="<?php echo get_template_directory_uri(); ?>/assets/images/keyboard_arrow_down.svg" alt="Стрелка" style="vertical-align: middle">
                </button>
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
                <button class="filter-btn"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/swap_vert.svg" alt="Иконка" style="vertical-align: middle">
                    Сортировка <img src="<?php echo get_template_directory_uri(); ?>/assets/images/keyboard_arrow_down.svg" alt="Стрелка" style="vertical-align: middle">
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