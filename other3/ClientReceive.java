eInt(fileName.length());
            out.write(fileName.getBytes());
            socket.close();
        } catch (Exception e) {
            System.out.println(e);
        }

    }

}
