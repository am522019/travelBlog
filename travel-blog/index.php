<?php
session_start();
$page_title = ' Home Page';
?>

<?php include 'tpl/header.php' ?>
<main class="min-height-900">
    <div class="container">
        <section id="header-content">
            <div class="row">
                <div class="col-12 text-center mt-3 mb-4">
                    <h1 class="display-4">Welcome To Travel Blog</h1>

                    <blockquote class="blockquote text-center">
                        <p class="mb-0 quotes">“The world is a book and those who do not travel read <br> only one
                            page.”
                        </p>
                        <footer class="blockquote-footer">St. Augustine </footer>
                    </blockquote>
                    <p class="mt-4">
                        <a href="signup.php" class="btn btn-outline-warning btn-lg ">START YOUR
                            JOURNEY <i class="far fa-compass"></i></a>
                    </p>
                </div>
            </div>
        </section>
        <section id="main-content">
            <div class="row ">
                <div class="col-lg-7 ml-2 mt-5">
                    <p class="example-story">ONE STORY OF MANY</p>
                    <h5 class="mt-3"><strong>Braving It:</strong> A Father, a Daughter, and an Unforgettable Journey
                        Into the
                        Alaskan Wilderness
                    </h5>
                    <p class="mt-4">By James Campbell
                        (Crown, 2016)
                        The idea of spending a vacation doing grueling outdoor work with a teenager is scary enough
                        for most parents without adding the threat of grizzly bears. But Aidan Campbell is not every
                        teenager, and her father James Campbell isn’t every parent. In Braving It, Campbell
                        chronicles their three trips to Alaska, including a summer spent helping family members
                        build a log cabin in the Arctic National Wildlife Refuge and a fall visit to set trap lines
                        for hunting. Their adventure culminates in a final backpacking and canoeing trip that takes
                        them through the Brooks Range and along the Hulahula River all the way to the Arctic Ocean.
                        If the descriptions of rugged living in the Alaskan landscape don’t keep you reading (or at
                        least inspire you to do some image searches of the National Wildlife Refuge), the tender
                        evolution of the relationship between a father and his teenage daughter will. And it may
                        even offer some ideas for your next family vacation.
                    </p>
                </div>
                <div class="col-lg-4 mt-5 mb-3 ">
                    <img height="450px" width="500px" src="images/camp1.jpg" alt="">
                </div>

            </div>
        </section>
    </div>
</main>

<?php include 'tpl/footer.php' ?>