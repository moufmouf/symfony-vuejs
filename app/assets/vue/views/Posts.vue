<template>
    <div>
        <div class="row col">
            <h1>Posts</h1>
        </div>

        <form>
            <div class="form-row">
                <div class="col-8">
                    <input v-model="search" type="text" class="form-control" placeholder="Search">
                </div>
            </div>
        </form>

        <ApolloQuery
                :query="require('../graphql/posts.gql')"
                :variables="{ search }"
        >
            <template slot-scope="{ result: { loading, error, data } }">
                <!-- Loading -->
                <div v-if="loading" class="loading apollo row col">Loading...</div>

                <!-- Error -->
                <div v-else-if="error" class="error apollo row col">An error occurred</div>

                <!-- Result -->
                <div v-else-if="data" class="result apollo row py-3">
                    <div v-for="post in data.posts" class="card p-2 m-2" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Article</h5>
                            <p class="card-text">{{ post.message }}

                            <div><em>by {{ post.author.login }}</em></div>
                            </p>
                            <a href="#" class="btn btn-primary">See article</a>
                        </div>
                    </div>
                </div>

                <!-- No result -->
                <div v-else class="no-result apollo">No result :(</div>
            </template>
        </ApolloQuery>
    </div>
</template>

<script>
    export default {
        name: 'posts',
        data () {
            return {
                search: ''
            };
        },
    }
</script>