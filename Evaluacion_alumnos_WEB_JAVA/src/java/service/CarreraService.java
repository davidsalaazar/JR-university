package service;

import dao.DAO;
import java.util.ArrayList;
import java.util.List;
import modelo.CarreraModelo;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 06:21:27 PM
 * @encoding UTF-8
 * @empresa SOMA
 * @version 1.0
 */
public class CarreraService {

    private CarreraModelo carrera = null;

    private List<CarreraModelo> lCarrera = null;

    private DAO dao = new DAO();

    public CarreraModelo buscaCarreraPorNombre(String nombreCarrera) {
        List<Object> lCondicion = new ArrayList();
        List<Object> lValor = new ArrayList();

        lCondicion.add("nombre");

        lValor.add(nombreCarrera);

        List<Object> lObjeto = dao.busca(CarreraModelo.class, lCondicion.toArray(), lValor.toArray());

        for (Object object : lObjeto) {
            carrera = (CarreraModelo) object;
        }

        return carrera;
    }

    public List<CarreraModelo> buscaCarrera() {
        List<Object> lObjeto = dao.busca(CarreraModelo.class, null, null);

        lCarrera = new ArrayList();

        for (Object object : lObjeto) {
            lCarrera.add((CarreraModelo) object);
        }
        return lCarrera;
    }

    public boolean agregaCarrera(List<CarreraModelo> lCarrera) {
        List<Object> lObjeto = new ArrayList();

        for (CarreraModelo carrera : lCarrera) {
            lObjeto.add(carrera);
        }

        if (!lObjeto.isEmpty()) {
            return dao.insertUpdate(lObjeto);
        }
        return false;
    }
}
