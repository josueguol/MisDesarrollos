import React from 'react';
import { View, Text, StyleSheet, Button } from 'react-native';
import Header from '../Header/Header';

export default function home ({ navigation }) {
    return (
        <View style={styles.container}>
            <Header title="Inicio" navigation={navigation} />
            <View style={styles.content}>
                <Text style={styles.text}>Home</Text>
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
        backgroundColor: '#03cafc'

    },
    text: {
        fontSize: 20,
        color: '#ffffff',
        fontWeight: '800'
    }
})