<!-- Guitar Quest: Level Modals -->

<!-- Level Modal  -->
<div x-show.transition.opacity="levelModalOpen"
     x-on:keydown.escape="levelModalOpen = false;"
     x-cloak
     class="fixed justify-center items-center inset-0 bg-black bg-opacity-75 z-250 soft-flex">

    <!-- Flex Wrapper -->
    <div class="flex min-h-full items-center justify-center"
         x-on:click.away="levelModalOpen = false;"
    >
        <!-- Previous Button -->
        <button class="text-white text-7xl cursor-pointer focus:outline-none"
                x-bind:class="{ 'pointer-events-none opacity-40': levelModalOpen === 1 }"
                x-on:click.stop="levelModalOpen -= 1">
            <i class="fas fa-angle-left"></i>
        </button>

        <!-- Modal Wrapper -->
        <div class="w-screen max-w-xl p-3 h-screen overflow-auto flex scrollbar-none"
             x-on:click="levelModalOpen = false;">

            <!-- Level One Modal -->
            <div x-show="levelModalOpen === 1"
                 x-on:click.stop
                 class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-1-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=1ab22facad3a99b9c5a3ab59cfcc3f9b" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">9 Videos // 10 Challenges</h4>
                    <p class="text-sm">There’s a concert going on RIGHT NOW but the guitarist didn’t show. And they’re turning to you. Just learn these chords… You’ll get a simple crash course so you can fill in for the show (even though you’ve never played guitar before).</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Holding Your Guitar</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Tuning Your Guitar</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Strumming All The Strings</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Strumming To Jam Tracks</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Strumming The G Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Practice Two Chords</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The Show!</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Explore All The Frets</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Write A Simple Melody</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Share Your Melody (Optional)</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Two Modal -->
            <div x-show="levelModalOpen === 2"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-2-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=029027bcdf62593d95e1e4959775a635" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">8 Videos // 9 Challenges</h4>
                    <p class="text-sm">You don't want the rest of your band to know that you don't play guitar -- and there's a music video shoot coming up soon. So you’re going to prepare with a secret guitar lesson in a secret location, where you'll learn the absolute basics and how to make it seem like you've been playing for a long time.</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Get Familiar With Your Guitar</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Explore Your Amp (Optional)</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Different Amp Settings (Optional)</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Changing Your Strings</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Playing The G Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Your First Simple Melody w/ 1 Finger</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Your First Simple Melody w/ 2 Fingers</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Trick Yourself Into Practicing</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Share Your Melody (Optional)</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Three Modal -->
            <div x-show="levelModalOpen === 3"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-3-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=4c64fc507666feea5fbfa51e089adb30" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">9 Videos // 13 Challenges</h4>
                    <p class="text-sm">It's time for the new music video -- and if you can quickly learn the song before the band shows up, no one will ever notice that you don't actually play guitar. You've got this -- with some basic strumming and easy new chords.</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Strumming Pattern #1</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Strumming Pattern #2</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Strumming Pattern #3</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The E Major Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">E Major Strumming Patterns</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Two New Chords</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Switching Between Chords</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Playing A Verse Progression</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">E Major Variations</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Playing The Chorus</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Playing A Song Intro</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Putting It All Together</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play With The Band</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Four Modal -->
            <div x-show="levelModalOpen === 4"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-4-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=9296666162d1f324dcef8d52f550fb7b" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">9 Videos // 12 Challenges</h4>
                    <p class="text-sm">The label needs more songs, so you’re heading into the mountains with an acoustic guitar to explore your creative side. But when you finally get settled around the campfire, a strange bearded man comes out of the woods and demands you play one of his songs. Oh, and he’s carrying an axe!</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Read Chord Charts</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The Open G Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Learn The C Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Switching From C To G</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Learn The E Minor Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Switching From E Minor To G</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Learn The A Minor Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Switching From A Minor To C</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Learn The D Chord</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Switching From G To D</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play A Chord Progression</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The Campfire Song</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Five Modal -->
            <div x-show="levelModalOpen === 5"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-5-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=87d7668b114c6c1c28f43c7e3afe7858" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">12 Videos // 6 Challenges</h4>
                    <p class="text-sm">Your band is exploding in popularity and you've decided to immediately sell out and play commercial jingles while the iron is hot. It's time for you to double-down on basic guitar techniques that'll let you play catchier tunes and add more color to your playing.</p>
                    <ul class="text-sm list-none ml-0">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Palm Muting</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Slides</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">String Skipping</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Vibrato</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Tremolo Picking</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play 4 Jingles</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Six Modal -->
            <div x-show="levelModalOpen === 6"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-6-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=827a0b3e1815df14e30a1fbbf57e121a" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">9 Videos // 7 Challenges</h4>
                    <p class="text-sm">After selling out, the band needs to re-establish itself for the diehard fans -- and what better way than a punk show! Your audience will expect something hardcore, so it's time for you to get familiar with the fretboard and play some power chords!</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Get Familiar With The Fretboard</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Practice The One Note Riff</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Two Finger Power Chord Riff</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Three Finger Power Chord Riff</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Picking Hand Techniques</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Song Structure</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Perform A Punk Song</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Seven Modal -->
            <div x-show="levelModalOpen === 7"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-7-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=67bab0b81fb356d763a8fae56d8adfbd" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">7 Videos // 11 Challenges</h4>
                    <p class="text-sm">You're in the studio recording a song, but your 'Post-Alaskan Indie Folk' band isn't very productive. There are some elements recorded, but you REALLY need to fill in the gaps and finish the song while they’re gone. It needs to be done today. It’s your time to shine!</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Explore Thirds In The Key Of G-Major</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Explore Thirds With Full Strums</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Arpeggios</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Write Your Own Arpeggio Pattern</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Writing A Simple Guitar Solo</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Share Your Solo (Optional)</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Chord Progressions</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Write Your Own Chord Progression</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Finalize The Song</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Add Lyrics (Optional)</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Perform The Full Song</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Eight Modal -->
            <div x-show="levelModalOpen === 8"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-8-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=fc9c7a85c8e7c9cbe82b7e16211ab731" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">9 Videos // 15 Challenges</h4>
                    <p class="text-sm">The band is growing tired of writing music. “Let’s just play covers!” You’ve got some skills, but a new challenge awaits: how do you learn how to play ANY song on the guitar… fast?</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The World Of Guitar Tabs</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Learn The Song You Found</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">How To Find A Bajillion Singy Songs</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Reading Chord Charts</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Try The Wibblespoons Song</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Using A Capo To Play Songs</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Song Writing</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Little Bit About Music Theory</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Major Scale & Keys</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The G-Major Scale</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Increasing Your Dexterity</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Basic Music Theory</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Notes On The Fretboard</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Major & Minor Chords</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Learn Any Song You Want</span></li>
                    </ul>
                </div>
            </div>

            <!-- Level Nine Modal -->
            <div x-show="levelModalOpen === 9"
                x-on:click.stop
                class="container my-auto max-w-xl overflow-hidden rounded-2xl bg-white font-primary text-gray-700">
                <img src="https://musora.imgix.net/https%3A%2F%2Fd122ay5chh2hr5.cloudfront.net%2Fguitarquest%2Fassets%2FGuitar-Quest-9-0.png?auto=format&ixlib=php-1.2.1&w=2000&s=3dbab20b2a24fa1684f66bcbe63676cd" />
                <div class="p-6">
                    <h4 class="text-goldenrod mb-4 font-bold uppercase text-center font-primary">10 Videos // 10 Challenges</h4>
                    <p class="text-sm">Here's the final song. The final boss. It's everything you've learned so far in ONE high energy tune -- and it's so satisfying to pull off. If you can muster up the skill and determination to play this, you've completed your GuitarQuest!</p>
                    <ul class="list-none ml-0 text-sm">
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Chorus Riff (1st Half)</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Chorus Riff (2nd Half)</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Verse Riff</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">The Verse On The High E String</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The Breakdown</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The Bridge</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The Intro</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Play The Ending</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Putting Everything Together</span></li>
                        <li><i class="fas fa-check-circle mr-2"></i> <span class="font-semibold">Challenging The Final Boss</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Next Button -->
        <button class="text-white text-7xl cursor-pointer focus:outline-none"
                x-bind:class="{ 'pointer-events-none opacity-40': levelModalOpen === 9 }"
                x-on:click.stop="levelModalOpen += 1">
            <i class="fas fa-angle-right"></i>
        </button>
    </div>

    <!-- Close Modal Button -->
    <button class="text-white absolute text-5xl md:text-7xl cursor-pointer top-1 right-1 focus:outline-none"
            x-on:click.stop="levelModalOpen = false;">
        <i class="fas fa-times"></i>
    </button>

</div>
