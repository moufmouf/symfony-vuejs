import Vue from 'vue'
import VueApollo from 'vue-apollo'
import { ApolloClient } from 'apollo-client';
import { HttpLink } from 'apollo-link-http';
import { onError } from 'apollo-link-error';
import { InMemoryCache } from 'apollo-cache-inmemory';

Vue.use(VueApollo);

let httpLink = new HttpLink({ uri: '/graphql' }),
    errorLink = onError(({ networkError }) => {
        if (networkError.statusCode === 403) {
            // TODO I guess it does not work as this.$router should not exist in this context...
            this.$router.push({path: '/authentification'})
        } else if (networkError.statusCode === 500) {
            document.open();
            document.write(networkError.bodyText);
            document.close();
        }
    });

let apolloClient = new ApolloClient({
    link: errorLink.concat(httpLink),
    cache: new InMemoryCache(),
    connectToDevTools: true,
});

let apollo = new VueApollo({
    defaultClient: apolloClient,
});

export default apollo;
