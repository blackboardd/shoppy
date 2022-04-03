import { useEffect, useState } from 'react';
import { validateNumber } from '../validation/number';
import { IGroupProps, IUnitValue } from './group.interface';
import './group.styles.scss';

/**
 * Form group for products.
 *
 * @returns {JSX.Element} The form group for products.
 */
const Group = (props: IGroupProps): JSX.Element => {
  const { product, handlers, validations } = props;
  const [unitValue, setUnitValue] = useState<IUnitValue>({
    DISC: {
      size: '',
    },
    BOOK: {
      weight: '',
    },
    FURNITURE: {
      length: '',
      width: '',
      height: '',
    },
  });

  useEffect(() => {
    handlers.unitValue(unitValue);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [unitValue]);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>): void => {
    const { name, value } = e.target;

    const key = name.split('.')[0];
    const subKey = name.split('.')[1];

    // clone unitValue object and insert new value at subkey location at the key of unitValue
    const newUnitValue = {
      ...unitValue,
      [key]: { ...unitValue[key as keyof IUnitValue], [subKey]: value },
    };

    setUnitValue(newUnitValue);
  };

  const UnitValueError = (value: string, error: string): JSX.Element => {
    const isValid = validateNumber(String(value));

    return <div className="validation-error">{isValid ? '' : error}</div>;
  };

  const fields = {
    DISC: (
      <div className="disc-group">
        <div className="form-group-container">
          <div className="form-group">
            <label htmlFor="size">Size</label>
            <input
              required
              type="number"
              name="DISC.size"
              onInput={handleChange}
              placeholder="0"
              value={unitValue.DISC.size}
              className={`form-control ${
                validations.unitValue.isValid ? '' : 'invalid-input'
              }`}
              id="size"
            />
            {UnitValueError(unitValue.DISC.size, 'Invalid size.')}
          </div>
        </div>
      </div>
    ),
    BOOK: (
      <div className="book-group">
        <div className="form-group-container">
          <div className="form-group">
            <label htmlFor="weight">Weight</label>
            <input
              required
              type="number"
              name="BOOK.weight"
              onInput={handleChange}
              value={unitValue.BOOK.weight}
              placeholder="0"
              className={`form-control ${
                validations.unitValue.isValid ? '' : 'invalid-input'
              }`}
              id="weight"
            />
            {UnitValueError(unitValue.BOOK.weight, 'Invalid weight.')}
          </div>
        </div>
      </div>
    ),
    FURNITURE: (
      <div className="furniture-group">
        <div className="form-group-container">
          <div className="form-group">
            <label htmlFor="height">Height</label>
            <input
              required
              type="number"
              name="FURNITURE.height"
              onInput={handleChange}
              value={unitValue.FURNITURE.height}
              placeholder="0"
              className={`form-control ${
                validateNumber(unitValue.FURNITURE.height)
                  ? ''
                  : 'invalid-input'
              }`}
              id="height"
            />
            {UnitValueError(unitValue.FURNITURE.height, 'Invalid height.')}
          </div>
        </div>
        <div className="form-group-container">
          <div className="form-group">
            <label htmlFor="width">Width</label>
            <input
              required
              type="number"
              name="FURNITURE.width"
              onInput={handleChange}
              value={unitValue.FURNITURE.width}
              placeholder="0"
              className={`form-control ${
                validateNumber(unitValue.FURNITURE.width) ? '' : 'invalid-input'
              }`}
              id="width"
            />
            {UnitValueError(unitValue.FURNITURE.width, 'Invalid width.')}
          </div>
        </div>
        <div className="form-group-container">
          <div className="form-group">
            <label htmlFor="length">Length</label>
            <input
              required
              type="number"
              name="FURNITURE.length"
              onInput={handleChange}
              value={unitValue.FURNITURE.length}
              placeholder="0"
              className={`form-control ${
                validateNumber(unitValue.FURNITURE.length)
                  ? ''
                  : 'invalid-input'
              }`}
              id="length"
            />
            {UnitValueError(unitValue.FURNITURE.length, 'Invalid length.')}
          </div>
        </div>
      </div>
    ),
  };

  const attributeMessage = {
    DISC: <p>Please provide size.</p>,
    BOOK: <p>Please provide weight.</p>,
    FURNITURE: <p>Please provide dimensions.</p>,
  };

  return (
    <div>
      <div className="product-add-form-group-container">
        {fields[product.type]}
      </div>
      <div className="attribute-msg">{attributeMessage[product.type]}</div>
    </div>
  );
};

export default Group;
