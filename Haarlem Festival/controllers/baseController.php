<?php  
    class baseController
    {
        //Function to load the views
        public static function createView(string $viewName) 
        {
            require_once('views/'.$viewName. 'View.php');
        }

        //Function to load the menu
        public function loadMenu(string $active) {
            include('views/modules/navVisitor.php');
        }

        //Function to load the footer
        public function loadFooter() {
            include('views/modules/footer.php');
        }

        //Function to load the css files
        public function loadHead(string $title, string $pageName) {
            include('views/modules/head.php');
        }

        public function upCounter(string $counterName)
        {          
            // Add correct path to counter file.
            $path = 'cms/counters/'.$counterName.'Counter.txt';

            // Opens counter to read the number of hits.
            $file  = fopen( $path, 'r' );
            $count = fgets( $file, 1000 );
            fclose( $file );

            // Update the counter.
            $count = abs( intval( $count ) ) + 1;

            // Opens counterFile to change new hit number.
            $file = fopen( $path, 'w' );
            fwrite( $file, $count );
            fclose( $file );
        }
    }