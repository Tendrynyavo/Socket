package listener;

import client.Client;
import formulaire.Formulaire;

import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.File;

public class Download implements MouseListener {
    Formulaire form;
    Client client;

    public Download(Formulaire form, Client client) {
        this.form = form;
        this.client = client;
    }

    @Override
    public void mouseClicked(MouseEvent e) {
        try {
            client.receive(form.getText()[0]);
        } catch (Exception ex) {
            ex.printStackTrace();
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
