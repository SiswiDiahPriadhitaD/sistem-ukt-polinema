var initialPaginationCount = 5;
var currentPage = 1;
var paginationItems;
var paginationLength;

document.addEventListener("DOMContentLoaded", function () {
    paginationItems = document.querySelectorAll(".pagination li");
    paginationLength = paginationItems.length;

    adjustPagination();

    window.addEventListener("resize", adjustPagination);

    paginationItems.forEach(function (item, index) {
        item.addEventListener("click", function () {
            if (index === 0) {
                currentPage = Math.max(currentPage - 1, 1);
            } else if (index === paginationLength - 1) {
                currentPage = Math.min(currentPage + 1, paginationLength - 4);
            } else {
                currentPage = index + 1;
            }

            adjustPagination();
        });
    });
});

function adjustPagination() {
    var screenWidth = window.innerWidth;

    if (!paginationItems || paginationItems.length === 0) {
        return;
    }

    if (screenWidth <= 767) {
        paginationItems.forEach(function (item) {
            item.style.display = "none";
        });

        paginationItems[0].style.display = "inline-block";
        paginationItems[1].style.display = "inline-block";

        for (
            var i = currentPage - 1;
            i <=
            Math.min(
                currentPage + initialPaginationCount - 2,
                paginationLength - 4
            );
            i++
        ) {
            paginationItems[i].style.display = "inline-block";
        }

        paginationItems[paginationLength - 2].style.display = "inline-block"; // Next
        paginationItems[paginationLength - 1].style.display = "inline-block"; // Last
    } else {
        paginationItems.forEach(function (item) {
            item.style.display = "inline-block";
        });
    }
}
