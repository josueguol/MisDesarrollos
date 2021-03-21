import React from 'react';
import { View, Text, StyleSheet, Button } from 'react-native';
import Header from '../Header/Header';

const Notifications = ({ navigation }) => {
    return (
        <View style={styles.container}>
            <Header title="Notificaciones" navigation={navigation} />
            <View style={styles.content}>
                <Text style={styles.text}>Notificaciones</Text>
            </View>
        </View>
    ) 
};

const styles = StyleSheet.create({
    container: {
        flex: 1
    },
    content: {
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
        backgroundColor: '#0f4c5c'
    },
    text: {
        fontSize: 20,
        color: '#ffffff',
        fontWeight: '800'
    }
})

export default Notifications;