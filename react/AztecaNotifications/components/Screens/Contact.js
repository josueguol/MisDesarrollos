import React from 'react';
import { View, Text, StyleSheet, Button } from 'react-native';
import Header from '../Header/Header';

export default function Contact({ navigation }) {
    return (
        <View style={styles.container}>
            <Header title="Contacto" navigation={navigation} />
            <View style={styles.content}>
                <Text style={styles.text}>Contacts</Text>
                <Button
                    title="Atras"
                    onPress={ () => navigation.goBack() }
                />
            </View>
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        flex: 1
    },
    content: {
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
        backgroundColor: '#c203fc'

    },
    text: {
        fontSize: 20,
        color: '#ffffff',
        fontWeight: '800'
    }
})