package service;

import dao.DAO;
import java.util.ArrayList;
import java.util.List;
import modelo.CarreraModelo;
import modelo.MateriaModelo;

/**
 * @author David Salazar Mejia
 * @correo davidsm54@gmail.com
 * @fecha 10/07/2018
 * @hora 06:21:36 PM
 * @encoding UTF-8
 * @empresa SOMA
 * @version 1.0
 */
public class MateriaService {

    private MateriaModelo materia = null;

    private List<MateriaModelo> lMateria = null;

    private DAO dao = new DAO();

    public MateriaModelo buscaMateriaPorNombre(String nombreMateria) {
        List<Object> lCondicion = new ArrayList();
        List<Object> lValor = new ArrayList();

        lCondicion.add("nombreMateria");
        lValor.add(nombreMateria);

        List<Object> lObjeto = dao.busca(MateriaModelo.class, lCondicion.toArray(), lValor.toArray());

        for (Object object : lObjeto) {
            materia = (MateriaModelo) object;
        }

        return materia;
    }

    public List<MateriaModelo> buscaMateria() {
        List<Object> lObjeto = dao.busca(MateriaModelo.class, null, null);

        lMateria = new ArrayList();

        for (Object object : lObjeto) {
            lMateria.add((MateriaModelo) object);
        }
        return lMateria;
    }

    public boolean agregaMateria(List<MateriaModelo> lMateria) {
        List<Object> lObjeto = new ArrayList();

        for (MateriaModelo materia : lMateria) {
            lObjeto.add(materia);
        }

        if (!lObjeto.isEmpty()) {
            return dao.insertUpdate(lObjeto);
        }
        return false;
    }

}
