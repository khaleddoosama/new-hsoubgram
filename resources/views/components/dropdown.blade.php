@props([
    'align' => 'right',
    'width' => '48',
    'contentClasses' => 'py-1 bg-white'
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
        'top' => 'origin-top',
        default => 'ltr:origin-top-right rtl:origin-top-left end-0',
    };

    $widthClass = match ($width) {
        '48' => 'w-48',
        '96' => 'w-96',
        default => $width,
    };
@endphp

<div class="relative dropdown">
    <div class="dropdown-trigger">
        {{ $trigger ?? '' }}
    </div>

    <div class="dropdown-menu absolute z-50 mt-2 {{ $widthClass }} rounded-md shadow-lg {{ $alignmentClasses }} hidden">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content ?? '' }}
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdowns = document.querySelectorAll(".dropdown");

        dropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector(".dropdown-trigger");
            const menu = dropdown.querySelector(".dropdown-menu");

            trigger.addEventListener("click", function (event) {
                event.stopPropagation();
                menu.classList.toggle("hidden");
            });

            document.addEventListener("click", function () {
                menu.classList.add("hidden");
            });

            menu.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevent menu from closing when clicking inside
            });
        });
    });
</script>
