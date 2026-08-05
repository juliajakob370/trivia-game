<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Placeholder content for the category system. One full 10-question
        // round per category for now — expand these later.
        $this->seedCategory('Food', [
            ['What fruit is known as the "king of fruits" in Southeast Asia?', 'Mango', 'Durian', 'Rambutan', 'Lychee', 'B'],
            ['Which spice is derived from the crocus flower and is the most expensive by weight?', 'Saffron', 'Cinnamon', 'Nutmeg', 'Cardamom', 'A'],
            ['What is the main ingredient in traditional hummus?', 'Chickpeas', 'Lentils', 'Black beans', 'Kidney beans', 'A'],
            ['Which country is credited with inventing pizza in its modern form?', 'France', 'Greece', 'Italy', 'Spain', 'C'],
            ['Which of these is technically a fruit, not a vegetable?', 'Tomato', 'Carrot', 'Potato', 'Broccoli', 'A'],
            ['What is the primary flavor in traditional pesto sauce?', 'Basil', 'Parsley', 'Cilantro', 'Mint', 'A'],
            ['Sushi originated in which country?', 'China', 'Japan', 'Korea', 'Thailand', 'B'],
            ['What is the most consumed beverage in the world after water?', 'Coffee', 'Tea', 'Beer', 'Orange juice', 'B'],
            ['Which cheese is traditionally used on a Margherita pizza?', 'Cheddar', 'Mozzarella', 'Parmesan', 'Gouda', 'B'],
            ['What grain is the main ingredient in traditional Japanese sake?', 'Wheat', 'Barley', 'Rice', 'Corn', 'C'],
        ]);

        $this->seedCategory('Animals', [
            ['What is the largest land animal?', 'African elephant', 'White rhinoceros', 'Giraffe', 'Hippopotamus', 'A'],
            ['Which animal is known to sleep for up to 20 hours a day?', 'Koala', 'Sloth', 'Lion', 'Panda', 'A'],
            ['What is a baby kangaroo called?', 'Cub', 'Joey', 'Kid', 'Pup', 'B'],
            ['Which bird is known for its ability to mimic human speech?', 'Eagle', 'Parrot', 'Owl', 'Sparrow', 'B'],
            ['What is the fastest land animal?', 'Lion', 'Cheetah', 'Pronghorn', 'Greyhound', 'B'],
            ['How many legs does a spider have?', '6', '8', '10', '12', 'B'],
            ['Which mammal is the only one capable of true flight?', 'Flying squirrel', 'Bat', 'Sugar glider', 'Colugo', 'B'],
            ['What is the largest species of shark?', 'Great White Shark', 'Whale Shark', 'Tiger Shark', 'Hammerhead Shark', 'B'],
            ['Which big cat is known for having a mane in males?', 'Tiger', 'Lion', 'Leopard', 'Jaguar', 'B'],
            ['What do you call a group of lions?', 'Pack', 'Pride', 'Herd', 'Flock', 'B'],
        ]);

        $this->seedCategory('Movies', [
            ['Which movie won the first-ever Academy Award for Best Picture (1929)?', 'Wings', 'Metropolis', 'Sunrise', 'The Jazz Singer', 'A'],
            ['Who directed the movie "Jaws" (1975)?', 'George Lucas', 'Steven Spielberg', 'Martin Scorsese', 'Francis Ford Coppola', 'B'],
            ['Which studio produced the "Toy Story" franchise?', 'DreamWorks', 'Illumination', 'Pixar', 'Blue Sky Studios', 'C'],
            ['In "The Wizard of Oz," what color are Dorothy\'s iconic shoes?', 'Silver', 'Red', 'Gold', 'Blue', 'B'],
            ['Which actor played Iron Man in the Marvel Cinematic Universe?', 'Chris Evans', 'Chris Hemsworth', 'Robert Downey Jr.', 'Mark Ruffalo', 'C'],
            ['Which film franchise features a wizarding school called Hogwarts?', 'Lord of the Rings', 'Harry Potter', 'Narnia', 'Percy Jackson', 'B'],
            ['Which 1994 film features the line "Life is like a box of chocolates"?', 'Forrest Gump', 'Pulp Fiction', 'The Shawshank Redemption', 'Home Alone', 'A'],
            ['Who composed the iconic score for "Star Wars"?', 'Hans Zimmer', 'John Williams', 'James Horner', 'Danny Elfman', 'B'],
            ['Which animated film features the song "Let It Go"?', 'Moana', 'Frozen', 'Tangled', 'Encanto', 'B'],
            ['What is the name of the fictional African country in "Black Panther"?', 'Zamunda', 'Wakanda', 'Genovia', 'Sokovia', 'B'],
        ]);

        $this->seedCategory('Computers', [
            ['What does "CPU" stand for?', 'Central Process Unit', 'Central Processing Unit', 'Computer Personal Unit', 'Central Processor Utility', 'B'],
            ['Who is considered the co-founder of Apple alongside Steve Jobs?', 'Bill Gates', 'Steve Wozniak', 'Elon Musk', 'Larry Page', 'B'],
            ['What does "HTML" stand for?', 'HyperText Markup Language', 'HighText Machine Language', 'HyperTransfer Markup Language', 'Home Tool Markup Language', 'A'],
            ['Which company developed the Windows operating system?', 'Apple', 'IBM', 'Microsoft', 'Google', 'C'],
            ['What does "RAM" stand for?', 'Random Access Memory', 'Read Access Memory', 'Rapid Access Module', 'Random Allocation Memory', 'A'],
            ['The binary number system is based on which base?', 'Base 8', 'Base 10', 'Base 2', 'Base 16', 'C'],
            ['Which language powers Laravel, the web framework this game is built with?', 'Python', 'Ruby', 'PHP', 'JavaScript', 'C'],
            ['What does "URL" stand for?', 'Uniform Resource Locator', 'Universal Reference Link', 'Uniform Retrieval Location', 'Universal Resource Locator', 'A'],
            ['Which company created the JavaScript framework React?', 'Google', 'Microsoft', 'Meta (Facebook)', 'Amazon', 'C'],
            ['What does "SQL" stand for?', 'Structured Query Language', 'Sequential Query Logic', 'Simple Query Language', 'Structured Question Language', 'A'],
        ]);

        $this->seedCategory('Ocean', [
            ['What is the largest ocean on Earth?', 'Atlantic', 'Indian', 'Arctic', 'Pacific', 'D'],
            ['What is the deepest known point in Earth\'s oceans?', 'Mariana Trench', 'Puerto Rico Trench', 'Java Trench', 'Tonga Trench', 'A'],
            ['What is the largest animal to have ever lived on Earth?', 'Blue whale', 'Sperm whale', 'Whale shark', 'Giant squid', 'A'],
            ['Which ocean current is known for its warm waters flowing from the Gulf of Mexico?', 'Humboldt Current', 'Gulf Stream', 'Kuroshio Current', 'Benguela Current', 'B'],
            ['Roughly what percentage of Earth\'s surface is covered by oceans?', '50%', '60%', '71%', '85%', 'C'],
            ['What is a group of fish called?', 'Pod', 'School', 'Herd', 'Pack', 'B'],
            ['Which sea creature has three hearts?', 'Octopus', 'Squid', 'Jellyfish', 'Starfish', 'A'],
            ['What is coral primarily made of?', 'Plant matter', 'Rock', 'Tiny living animals (polyps)', 'Algae only', 'C'],
            ['Which sea is known for its unusually high salinity due to high evaporation and low freshwater inflow?', 'Baltic Sea', 'Red Sea', 'Black Sea', 'Caspian Sea', 'B'],
            ['What is the term for the tidal area where a river meets the sea?', 'Delta', 'Estuary', 'Isthmus', 'Fjord', 'B'],
        ]);

        $this->seedCategory('Music', [
            ['How many strings does a standard guitar have?', '4', '5', '6', '7', 'C'],
            ['Which composer wrote the "Ninth Symphony," completed while he was deaf?', 'Mozart', 'Bach', 'Beethoven', 'Chopin', 'C'],
            ['What does "BPM" stand for in music?', 'Beats Per Minute', 'Bars Per Measure', 'Bass Per Melody', 'Beats Per Measure', 'A'],
            ['Which band released the album "Abbey Road"?', 'The Rolling Stones', 'The Beatles', 'Led Zeppelin', 'Pink Floyd', 'B'],
            ['What is the term for singing without instrumental accompaniment?', 'Acoustic', 'A cappella', 'Falsetto', 'Unplugged', 'B'],
            ['Which instrument is Yo-Yo Ma famous for playing?', 'Violin', 'Piano', 'Cello', 'Flute', 'C'],
            ['How many keys are on a standard piano?', '76', '88', '92', '100', 'B'],
            ['Which genre of music is most directly credited to originating in New Orleans?', 'Reggae', 'Jazz', 'Country', 'Blues', 'B'],
            ['Who is known as the "King of Pop"?', 'Elvis Presley', 'Prince', 'Michael Jackson', 'Freddie Mercury', 'C'],
            ['What clef is typically used for bass notes?', 'Treble clef', 'Bass clef', 'Alto clef', 'Tenor clef', 'B'],
        ]);

        $this->seedCategory('Space', [
            ['What is the closest planet to the Sun?', 'Venus', 'Earth', 'Mercury', 'Mars', 'C'],
            ['Who was the first human to walk on the Moon?', 'Buzz Aldrin', 'Neil Armstrong', 'Yuri Gagarin', 'John Glenn', 'B'],
            ['What is the name of our galaxy?', 'Andromeda', 'Milky Way', 'Triangulum', 'Whirlpool', 'B'],
            ['Which planet is known for its prominent ring system?', 'Jupiter', 'Uranus', 'Saturn', 'Neptune', 'C'],
            ['What is the term for a star that explodes at the end of its life?', 'Black hole', 'Supernova', 'Nebula', 'Pulsar', 'B'],
            ['About how long does it take Earth to orbit the Sun?', '24 hours', '30 days', '365.25 days', '12 years', 'C'],
            ['Which was the first artificial satellite launched into space?', 'Sputnik 1', 'Apollo 11', 'Voyager 1', 'Explorer 1', 'A'],
            ['What is the largest planet in our solar system?', 'Saturn', 'Jupiter', 'Neptune', 'Uranus', 'B'],
            ['What do you call a large cloud of gas and dust in space where stars form?', 'Galaxy', 'Nebula', 'Asteroid belt', 'Comet', 'B'],
            ['Which space agency led the James Webb Space Telescope mission?', 'ESA', 'NASA', 'Roscosmos', 'JAXA', 'B'],
        ]);

        $this->seedCategory('Sports', [
            ['How many players are on a standard soccer (football) team on the field at once?', '9', '10', '11', '12', 'C'],
            ['In tennis, what is a score of zero called?', 'Nil', 'Love', 'Deuce', 'Ace', 'B'],
            ['How many rings are on the Olympic flag?', '4', '5', '6', '7', 'B'],
            ['Which country won the first-ever FIFA World Cup in 1930?', 'Brazil', 'Uruguay', 'Argentina', 'Italy', 'B'],
            ['In basketball, how many points is a standard field goal worth from inside the three-point line?', '1', '2', '3', '4', 'B'],
            ['What sport is played at Wimbledon?', 'Golf', 'Tennis', 'Cricket', 'Rugby', 'B'],
            ['How many players are on a standard basketball team on the court at once?', '4', '5', '6', '7', 'B'],
            ['In golf, what term describes completing a hole one stroke under par?', 'Bogey', 'Eagle', 'Birdie', 'Albatross', 'C'],
            ['Which country hosted the 2016 Summer Olympics?', 'China', 'United Kingdom', 'Brazil', 'Japan', 'C'],
            ['The Summer Olympic Games are scheduled to be held how often?', 'Every 2 years', 'Every 3 years', 'Every 4 years', 'Every 5 years', 'C'],
        ]);

        $this->seedCategory('Geography', [
            ['What is the largest country in the world by land area?', 'Canada', 'China', 'United States', 'Russia', 'D'],
            ['Which African river is the longest river in Africa?', 'Congo River', 'Niger River', 'Nile River', 'Zambezi River', 'C'],
            ['Which desert is the largest hot desert in the world?', 'Gobi Desert', 'Kalahari Desert', 'Sahara Desert', 'Arabian Desert', 'C'],
            ['What is the capital of Australia?', 'Sydney', 'Melbourne', 'Canberra', 'Perth', 'C'],
            ['Which mountain is the tallest in the world above sea level?', 'K2', 'Mount Kilimanjaro', 'Mount Everest', 'Denali', 'C'],
            ['How many continents are there?', '5', '6', '7', '8', 'C'],
            ['Which country is transcontinental, spanning both Europe and Asia?', 'Turkey', 'Egypt', 'Morocco', 'Greece', 'A'],
            ['What is the smallest country in the world by area?', 'Monaco', 'San Marino', 'Vatican City', 'Liechtenstein', 'C'],
            ['Which river flows through Egypt?', 'Amazon', 'Nile', 'Congo', 'Niger', 'B'],
            ['What is the capital of Japan?', 'Osaka', 'Kyoto', 'Tokyo', 'Yokohama', 'C'],
        ]);

        $this->seedCategory('Video Games', [
            ['Which company created the video game franchise "Super Mario"?', 'Sega', 'Nintendo', 'Sony', 'Capcom', 'B'],
            ['Which video game is widely cited as the best-selling video game of all time?', 'Tetris', 'Minecraft', 'Grand Theft Auto V', 'Wii Sports', 'B'],
            ['In chess, how many squares are on the board?', '32', '48', '64', '100', 'C'],
            ['Which video game franchise features a green-clad hero named Link?', 'Final Fantasy', 'The Legend of Zelda', 'Kingdom Hearts', 'Metroid', 'B'],
            ['What is the objective of the card game "Uno"?', 'Collect all four suits', 'Be the first to get rid of all your cards', 'Build the highest score', 'Trade cards with opponents', 'B'],
            ['Which company developed the "PlayStation" console?', 'Microsoft', 'Nintendo', 'Sony', 'Atari', 'C'],
            ['In Monopoly, how much money do you collect when you pass "Go"?', '$100', '$200', '$300', '$400', 'B'],
            ['How many pieces does each player start with in a game of chess?', '12', '14', '16', '18', 'C'],
            ['Which puzzle video game involves fitting falling blocks together?', 'Pac-Man', 'Tetris', 'Snake', 'Space Invaders', 'B'],
            ['In standard Scrabble, how many points is each "Q" or "Z" tile worth?', '5', '8', '10', '12', 'C'],
        ]);
    }

    /**
     * Insert a category's worth of questions.
     * Each row is [question_text, option_a, option_b, option_c, option_d, correct_option].
     */
    private function seedCategory(string $categoryName, array $rows): void
    {
        $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');

        DB::table('questions')->insert(array_map(
            fn (array $row) => [
                'question_text' => $row[0],
                'option_a' => $row[1],
                'option_b' => $row[2],
                'option_c' => $row[3],
                'option_d' => $row[4],
                'correct_option' => $row[5],
                'category_id' => $categoryId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            $rows
        ));
    }
}
