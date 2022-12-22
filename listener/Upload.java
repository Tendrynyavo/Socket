package listener;

import client.Client;

import javax.swing.*;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;

public class Upload implements MouseListener {
    Client client;

    public Upload(Client client) {
        this.client = client;
    }

    @Override
    public void mouseClicked(MouseEvent e) {
        try {
            JFileChooser fileChooser = new JFileChooser();
            fileChooser.showOpenDialog(null);
            client.sendFile(fileChooser.getSelectedFile());
        } catch (Exception error) {
            JOptionPane.showMessageDialog(new JFrame(), error.getMessage());
        }
    }

    @Override
    public void mousePressed(MouseEvent e) {

    }

    @Override
    public void mouseReleased(MouseEvent e) {

    }

    @Override
    public void mouseEntered(MouseEvent e) {

    }

    @Override
    public void mouseExited(MouseEvent e) {

    }
}
