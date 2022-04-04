import { Boxes } from 'react-bootstrap-icons';
import { ICommonProps } from './common.interface';
import { generateSKU } from '../helpers/generator';

/**
 * Common form group component.
 *
 * @param {ICommonProps} props - Props.
 * @returns {JSX.Element} The common form group component.
 */
const Common = (props: ICommonProps): JSX.Element => {
  const { handlers, updateSku, validations } = props;

  const handleSkuGeneration = (): void => {
    // target name input and get value
    const nameInput = document.getElementById('name') as HTMLInputElement;
    const name = nameInput.value;

    const sku = generateSKU(name);

    updateSku(sku);

    // target sku input and set value
    const skuInput = document.getElementById('sku') as HTMLInputElement;
    skuInput.value = name ? sku : '';
  };

  const SkuError = (): JSX.Element => {
    const { error, isValid } = validations.sku;

    return <div className="validation-error">{isValid ? '' : error}</div>;
  };

  const NameError = (): JSX.Element => {
    const { error, isValid } = validations.name;

    return <div className="validation-error">{isValid ? '' : error}</div>;
  };

  const PriceError = (): JSX.Element => {
    const { error, isValid } = validations.price;

    return <div className="validation-error">{isValid ? '' : error}</div>;
  };

  return (
    <div className="product-add-common">
      <div className="form-group-container">
        <div className="form-group">
          <label htmlFor="sku">SKU</label>
          <div style={{ display: 'flex', flexDirection: 'row' }}>
            <input
              required
              type="text"
              placeholder={`SKU`}
              onChange={handlers.sku}
              className={`form-control ${
                validations.sku.isValid ? '' : 'invalid-input'
              }`}
              id="sku"
            />
            <div className="generate-sku">
              <button
                type="button"
                onClick={handleSkuGeneration}
                className="btn btn-secondary"
                data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                title="Generate SKU"
              >
                <Boxes />
              </button>
            </div>
          </div>
        </div>
        {SkuError()}
      </div>
      <div className="form-group-container">
        <div className="form-group">
          <label htmlFor="name">Name</label>
          <input
            required
            type="text"
            placeholder={`Name`}
            onChange={handlers.name}
            className={`form-control ${
              validations.name.isValid ? '' : 'invalid-input'
            }`}
            id="name"
          />
          {NameError()}
        </div>
      </div>
      <div className="form-group-container">
        <div className="form-group">
          <label htmlFor="price">Price</label>
          <div className="input-group">
            <span className="input-group-addon">$</span>
            <input
              required
              type="number"
              step="0.01"
              placeholder="0.00"
              onChange={handlers.price}
              className={`form-control ${
                validations.price.isValid ? '' : 'invalid-input'
              }`}
              id="price"
            />
          </div>
          {PriceError()}
        </div>
      </div>
    </div>
  );
};

export default Common;
