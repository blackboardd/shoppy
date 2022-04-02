import { useState } from 'react';
import { combineUnits } from '../helpers/product';
import { IProductProps } from './interface';
import './styles.scss';

/**
 * Product component.
 *
 * @param {IProductProps} props - Props.
 * @returns {JSX.Element}
 */
const Product = (props: IProductProps): JSX.Element => {
  // usestate for checked
  const [checked, setChecked] = useState(false);

  const { product } = props;
  const { sku, name, price, type, currency, unit, unit_value } = product;

  const combinedUnit = combineUnits(unit, unit_value, type);

  // div className="product" should have an onClick function that calls setChecked
  const handleClick = (): void => {
    setChecked(!checked);
  };

  return (
    <div className="product" onClick={handleClick}>
      <div className="product__info">
        <div className="product__sku">{sku}</div>
        <div className="product__name">{name}</div>
        <div className="product__price">
          {currency}
          {price}
        </div>
        <div className="product__unit">{combinedUnit}</div>
      </div>
      <div className="product-checkbox">
        <input className="form-check-input" checked={checked} type="checkbox" />
      </div>
    </div>
  );
};

export default Product;
