<template>
    <v-row
        justify="center"
        align="center"
        class="fill-height"
    >
        <v-col
            md="4"
        >
            <Container>
                <Login />
            </Container>
        </v-col>
    </v-row>
</template>

<script>
import Login from './Login'
import Container from '../../components/standar/ContainerWithAlert'

export default {
    components : {
        Container,
        Login
    }
}
</script>