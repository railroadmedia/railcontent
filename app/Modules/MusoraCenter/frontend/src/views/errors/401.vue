<template>
    <v-container>
        <v-row
            
            align="center"
            justify="center"
            
            class="mt-4 fill-height"
        >
            <v-col
                cols="12"
                class="text-center column align-center justify-center"
            >
                <h1 class="display-4 text-center">
                    401
                </h1>
                <h4 class="text-light headline text-center mb-4">
                    Sorry, you do not have access to this page.
                </h4>
                <v-btn
                    :to="{ name: 'home' }"
                    :active-class="''"
                    flat
                >
                    <v-icon
                        left
                        dark
                    >
                        arrow_left
                    </v-icon>
                    Back to Home
                </v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<style scoped>
    .text-light {
        font-weight:300;
    }
</style>
